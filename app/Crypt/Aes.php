<?php

namespace App\Crypt;

use App\Exceptions\InvalidRequestException;
use Carbon\Carbon;

class Aes
{

//    headers 参数
//sign:71f3715ab1793edc79bdb78f7d693bfe
//timestamp:1660133175

// body 内容加密
//name:gyp719
//age:28
//city:深圳

    // 时间误差, 0-不限制
    protected int $timeError = 0;
    // 密钥
    protected $secretKey;
    // 签名字段
    protected string $signField = 'sign';

    public function __construct()
    {
        $this->secretKey = config('app.aes');
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
    protected function asciiSort($data): string
    {
        // 移除sign字段
        if (isset($data['sign'])) {
            unset($data['sign']);
        }
        ksort($data);

        $sign = '';
        foreach ($data as $k => $v) {
            if ($this->signField !== $k) {
                $sign .= $k."=".$v."&";
            }
        }
        return trim($sign, "&");
    }

    // 生成签名
    protected function generateSign($data): string
    {
        $string = $this->asciiSort($data);
        // 在string后加入KEY
        return md5($string."&key=".$this->secretKey);
    }

    /**
     * 签名验证
     * @throws InvalidRequestException
     */
    public function verifySign($data, $headers)
    {
        if (empty($headers['sign'])) {
            throw new InvalidRequestException('sign 不存在');
        }
        if ($this->timeError && !$this->allowTimestamp($headers['timestamp'])) {
            throw new InvalidRequestException('timestamp 超时');
        }

        // 生成签名
        $sign = $this->generateSign($data);

        logger('AES生成签名：'.$sign);

        if (!hash_equals($sign, $headers['sign'])) {
            throw new InvalidRequestException('sign 不正确');
        }

        return true;
    }
}
