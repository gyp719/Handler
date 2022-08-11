<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SmsHandler
{
    public function sendSms_1($mobile, $send_type = 'random')
    {
        $url      = 'https://app-api.yizhiweixin.com/login/code';
        $response = Http::get($url, [
            'phone' => $mobile,
        ]);

        if ($response['code'] != 200) {
            logger('[易知短信] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[易知短信] '.$response);
        }

        return $response->json();
    }

    public function sendSms_2($mobile, $send_type = 'random')
    {
        $url      = 'https://life-api.cars.shengxintech.com/api/verification/mobile/send';
        $response = Http::post($url, [
            'address' => $mobile,
        ]);

        if ($response['code'] != 200) {
            logger('[车生活] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[车生活] '.$response);
        }

        return $response->json();
    }

    public function sendSms_3($mobile, $send_type = 'random')
    {
        $url      = 'https://wx.kaikeba.com/opencourseapi/common/code/'.$mobile;
        $response = Http::get($url);

        if ($response['code']) {
            logger('[开课吧] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[开课吧] '.$response);
        }

        return $response->json();
    }

    public function sendSms_4($mobile, $send_type = 'random')
    {
        $url      = 'https://insuranceapi.gzjunbo.net/api/placeOrder/getAuthCode';
        $response = Http::post($url, [
            'channel'   => 'tkzx',
            'pid'       => 37116,
            'telephone' => $mobile,
        ]);

        if ($response['data']['responseCode'] != '000000') {
            logger('[泰康在线] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[泰康在线] '.$response);
        }

        return $response->json();
    }

    public function sendSms_5($mobile, $send_type = 'random')
    {
        $uuid     = Str::uuid();
        $url      = "https://api.58duihuan.com/mallSix/api/v6/code/send?phone={$mobile}&uuid={$uuid}&isSliderCode=true";
        $response = Http::get($url);

        if ($response['code'] == 400) {
            logger('[今日兑] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[今日兑] '.$response);
        }

        return $response->json();
    }

    public function sendSms_6($mobile, $send_type = 'random')
    {
        $source = ['miniprogram', 'pc', 'h5'];
        $str    = array_rand($source);

        $url      = 'https://api-xfb.cechoice.com/v6.5.1/auth/sendSmsCaptcha';
        $response = Http::withHeaders([
            'source' => $source[$str],
        ])->post($url, [
            'mobile' => $mobile,
        ]);

        if ($response['msg_type'] == '-1') {
            logger('[消费宝] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[消费宝] '.$response);
        }

        return $response->json();
    }

    public function sendSms_7($mobile, $send_type = 'random')
    {
        $url      = 'https://youwu.beneamo.com/api/verificationCodes';
        $response = Http::withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->get($url, [
            'phone' => $mobile,
        ]);

        if (isset($response['message'])) {
            logger('[游物鱼] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[游物鱼] '.$response);
        }

        return $response->json();
    }

    public function sendSms($mobile): \Illuminate\Http\JsonResponse
    {
        $this->sendSms_1($mobile);
        $this->sendSms_2($mobile);
        $this->sendSms_3($mobile);
        $this->sendSms_4($mobile);
        $this->sendSms_5($mobile);
        $this->sendSms_6($mobile);
        $this->sendSms_7($mobile);

        return response()->json(['code' => 200, 'msg' => '发送完成']);
    }

}

