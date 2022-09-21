<?php

namespace App\Handlers;

class Aes
{
    private string $encryption_iv;

    private string $encryption_key;

    public function __construct()
    {
        $this->encryption_iv  = config('services.identify.identify_encryption_iv');
        $this->encryption_key = config('services.identify.identify_encryption_key');
    }

    // 加密
    public function aesEncrypt($string): string
    {
        return bin2hex(openssl_encrypt($string, 'AES-128-CTR', $this->encryption_key, OPENSSL_RAW_DATA, $this->encryption_iv));
    }

    // 解密
    public function aesDecrypt($string): string
    {
        return openssl_decrypt(hex2bin($string), 'AES-128-CTR', $this->encryption_key, OPENSSL_RAW_DATA, $this->encryption_iv);
    }
}