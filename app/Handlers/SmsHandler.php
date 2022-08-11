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

    public function sendSms_8($mobile, $send_type = 'random')
    {
        $url      = 'http://www.jinghai-ic.com/register.aspx/getcode';
        $response = Http::withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->post($url, [
            'strphone' => $mobile,
        ]);

        if ($response['d'] != 'suc') {
            logger('[京海商城] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[京海商城] '.$response);
        }

        return $response->json();
    }

    public function sendSms_9($mobile, $send_type = 'random')
    {
        $url      = 'http://www.original-ic.com/register.aspx/getcode';
        $response = Http::withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->post($url, [
            'strphone' => $mobile,
        ]);

        if ($response['d'] != 'suc') {
            logger('[世强芯半导体] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[世强芯半导体] '.$response);
        }

        return $response->json();
    }

    public function sendSms_10($mobile, $send_type = 'random')
    {
        $url      = 'https://res.hxbuy.com/verificationNoCaptchaCodes';
        $response = Http::post($url, [
            'mobile' => $mobile,
        ]);

        if ($response['status_code'] != 200) {
            logger('[华芯商城] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[华芯商城] '.$response);
        }

        return $response->json();
    }

    public function sendSms_11($mobile, $send_type = 'random')
    {
        $url      = 'https://mall.zhongxiang51.com/order/zxmall/sms/sms';
        $response = Http::asForm()->post($url, [
            'phoneNumber' => $mobile,
        ]);

        if ($response['code']) {
            logger('[白领优拼] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[白领优拼] '.$response);
        }

        return $response->json();
    }

    public function sendSms_12($mobile, $send_type = 'random')
    {
        $url      = 'https://api.store.lining.com/userc/v1/user/verification/code/getPhoneCode';
        $response = Http::post($url, [
            'receiver' => $mobile,
            'scene'    => 'LOGIN',
            'saasId'   => '8324992625302181585',
            'source'   => '2',
        ]);

        if (!$response['success']) {
            logger('[李宁官网] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[李宁官网] '.$response);
        }

        return $response->json();
    }

    public function sendSms_13($mobile, $send_type = 'random')
    {
        $url      = 'https://ucmp.sf-express.com/wxopen/weixin/sendLoginCode?mobile='.$mobile;
        $response = Http::post($url);

        if ($response['errorCode']) {
            logger('[顺丰速运] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[顺丰速运] '.$response);
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
        $this->sendSms_8($mobile);
        $this->sendSms_9($mobile);
        $this->sendSms_10($mobile);
        $this->sendSms_11($mobile);
        $this->sendSms_12($mobile);
        $this->sendSms_13($mobile);

        return response()->json(['code' => 200, 'msg' => '发送完成']);
    }

}

