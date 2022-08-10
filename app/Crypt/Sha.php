<?php

namespace App\Crypt;

use App\Exceptions\InvalidRequestException;
use Carbon\Carbon;

class Sha
{
    // HMAC-SHA256 https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=20_1

//Api-Appid:jtRJ5qoz1wIDvQkX
//Api-Timestamp:1660124629
//Api-Nonce-Str:123456
//Api-Sign:8C6DFB777B4F31D4CD5B898C7C4F3F71887CBD4CF6FBAB8913F08D098A587FFA1

// 调用
//$headers = [
//    'Api-Appid'     => $request->header('Api-Appid'),
//    'Api-Nonce-Str' => $request->header('Api-Nonce-Str'),
//    'Api-Timestamp' => $request->header('Api-Timestamp'),
//    'Api-Sign' => $request->header('Api-Sign'),
//];
//$sha = new Sha();
//return $sha->verifySign($headers);


    // 时间误差, 0-不限制
    protected int $timeError;
    // 密钥
    protected $key;

    public function __construct()
    {
        $this->timeError = 0;
        $this->key       = config('app.sha_key');
    }

    // 判断用户请求是否在对应时间范围
    protected function allowTimestamp($timestamp): bool
    {
        $queryTime = Carbon::createFromTimestamp($timestamp);

        $lfTime = Carbon::now()->subSeconds($this->timeError);

        $rfTime = Carbon::now()->addSeconds($this->timeError);

        if ($queryTime->between($lfTime, $rfTime, true)) {
            return true;
        }

        return false;
    }

    // 按字典序排序参数
    protected function asciiSort($headers): string
    {
        // 移除Api-Sign字段
        if (isset($headers['Api-Sign'])) {
            unset($headers['Api-Sign']);
        }
        ksort($headers);

        $buff = '';
        foreach ($headers as $k => $v) {
            if ($v != "" && !is_array($v)) {
                $buff .= $k."=".$v."&";
            }
        }
        return trim($buff, "&");
    }

    // 生成签名
    protected function generateSign($headers): string
    {
        $string = $this->asciiSort($headers);
        // 在string后加入KEY
        $string = $string."&key=".$this->key;
        // sha256加密
        $string = hash_hmac('SHA256', $string, $this->key);
        // 所有字符转为大写
        return strtoupper($string);
    }

    /**
     * 签名验证
     * @throws InvalidRequestException
     */
    public function verifySign($headers): bool
    {
        if (empty($headers['Api-Appid'])) {
            throw new InvalidRequestException('Api-Appid 不存在');
        }
        if (empty($headers['Api-Nonce-Str'])) {
            throw new InvalidRequestException('Api-Nonce-Str 不存在');
        }
        if (empty($headers['Api-Timestamp'])) {
            throw new InvalidRequestException('Api-Timestamp 不存在');
        }
        if (empty($headers['Api-Sign'])) {
            throw new InvalidRequestException('Api-Sign 不存在');
        }
        if ($this->timeError && !$this->allowTimestamp($headers['Api-Timestamp'])) {
            throw new InvalidRequestException('Api-Timestamp 超时');
        }
        // 生成签名
        $sign = $this->generateSign($headers);

        logger('HMAC-SHA256生成签名：'.$sign);

        if (!hash_equals($sign, $headers['Api-Sign'])) {
            throw new InvalidRequestException('Api-Sign 不正确');
        }

        return true;
    }


}
