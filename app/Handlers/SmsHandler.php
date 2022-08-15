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

    public function sendSms_14($mobile, $send_type = 'random')
    {
        $url      = 'http://erp.yiya.art/api/v1/verificationCodes';
        $response = Http::post($url, [
            'phone' => $mobile,
        ]);

        if ($response['code'] != 200) {
            logger('[易雅艺术] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[易雅艺术] '.$response);
        }

        return $response->json();
    }

    public function sendSms_15($mobile, $send_type = 'random')
    {
        $url      = 'https://api.octinn.com/account/send_verify_code';
        $response = Http::withHeaders([
            'OI-APPKEY' => 'b2fc67038bd1e30caf14850e926fb817',
        ])->post($url, [
            'phone' => "{$mobile}",
            'type'  => 5,
        ]);

        if (isset($response['msg'])) {
            logger('[生日管家] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[生日管家] '.$response);
        }

        return $response->json();
    }

    public function sendSms_16($mobile, $send_type = 'random')
    {
        $url      = 'https://wx.fangzongguan.com/fmwx/user/sendLogincode';
        $response = Http::get($url, [
            'phone' => $mobile,
        ]);

        if (!$response['success']) {
            logger('[房总管] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[房总管] '.$response);
        }

        return $response->json();
    }

    public function sendSms_17($mobile, $send_type = 'random')
    {
        $url      = 'https://shop.lebai.cc/shopapi/login/captcha';
        $response = Http::withHeaders([
            'version' => '1.8.6',
        ])->post($url, [
            'mobile' => $mobile,
        ]);

        if (!$response['code']) {
            logger('[创乐佰] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[创乐佰] '.$response);
        }

        return $response->json();
    }

    public function sendSms_18($mobile, $send_type = 'random')
    {
        $url      = 'https://szyrwl.com/steward/partner/user/getValidateCode';
        $response = Http::asForm()->post($url, [
            'mobileAccount' => $mobile,
            'type'          => 2,
        ]);

        if ($response['errcode']) {
            logger('[立行车管家] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[立行车管家] '.$response);
        }

        return $response->json();
    }

    public function sendSms_19($mobile, $send_type = 'random')
    {
        $url      = 'https://www.51marryyou.com/Index/getSmsCode';
        $response = Http::asForm()->post($url, [
            'phone' => $mobile,
        ]);

        if ($response['err']) {
            logger('[迈优文化] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[迈优文化] '.$response);
        }

        return $response->json();
    }

    public function sendSms_20($mobile, $send_type = 'random')
    {
        $url      = 'https://hweb-personalcenter.huazhu.com/check/getMobileCheckNo';
        $response = Http::post($url, [
            'mobile'      => $mobile,
            'mobilePlace' => 86,
            'source'      => 2,
        ]);

        if ($response['businessCode'] != '1000') {
            logger('[华住会] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[华住会] '.$response);
        }

        return $response->json();
    }

    public function sendSms_21($mobile, $send_type = 'random')
    {
        $url      = 'https://lingdong.biz.weibo.com/open/v1/form/mobile-verify-code';
        $response = Http::post($url, [
            'mobile'    => $mobile,
            'page_id'   => '2233719303234845',
            'form_id'   => time(),
            '_pagetype' => 'new-h5',
        ]);

        if ($response['code']) {
            logger('[微博] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[微博] '.$response);
        }

        return $response->json();
    }

    public function sendSms_22($mobile, $send_type = 'random')
    {
        $url      = 'https://appapi.xicaishe.com/api/common/sendSmsCode';
        $response = Http::post($url, [
            'mobile' => $mobile,
            'source' => 1,
            'pageId' => 202128159255776217,
        ]);

        if ($response['code']) {
            logger('[习财社] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[习财社] '.$response);
        }

        return $response->json();
    }

    public function sendSms_23($mobile, $send_type = 'random')
    {
        $url      = 'https://shop.ydedear.com/wap/Login/sendSmsRegisterCode.html';
        $response = Http::withHeaders([
            'x-requested-with' => 'XMLHttpRequest'
        ])->post($url, [
            'mobile' => $mobile,
        ]);

        if ($response['code']) {
            logger('[亿蝶] '.$response);
        }

        if ($send_type == 'appoint') {
            logger('[亿蝶] '.$response);
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
        $this->sendSms_14($mobile);
        $this->sendSms_15($mobile);
        $this->sendSms_16($mobile);
        $this->sendSms_17($mobile);
        $this->sendSms_18($mobile);
        $this->sendSms_19($mobile);
        $this->sendSms_20($mobile);
        $this->sendSms_21($mobile);
        $this->sendSms_22($mobile);
        $this->sendSms_23($mobile);

        return response()->json(['code' => 200, 'msg' => '发送完成']);
    }

}

