<?php

namespace App\Crypt;

use App\Exceptions\InvalidRequestException;

class Rsa
{
    /**
     * 公钥加密
     * @throws InvalidRequestException
     */
    public function rsaPublicEncrypt($data): string
    {
        $public_key = file_get_contents(resource_path('rsa/rsa_public_key.pem'));

        $public_key = openssl_pkey_get_public($public_key);

        if (!$public_key) {
            throw new InvalidRequestException('公钥不可用');
        }
        // 第一个参数是待加密的数据只能是string，
        // 第二个参数是加密后的数据,
        // 第三个参数是openssl_pkey_get_public返回的资源类型,
        // 第四个参数是填充方式
        $return_en = openssl_public_encrypt($data, $encrypted, $public_key);
        if (!$return_en) {
            throw new InvalidRequestException('加密失败,请检查RSA秘钥');

        }
        return base64_encode($encrypted);
    }

    /**
     * 私钥解密
     * @throws InvalidRequestException
     */
    public function rsaPrivateDecrypt($eb64_cry)
    {
        $private_key = file_get_contents(resource_path('rsa/rsa_private_key.pem'));

        // 私钥解密
        $private_key = openssl_pkey_get_private($private_key);

        if (!$private_key) {
            throw new InvalidRequestException('私钥不可用');
        }

        $return_de = openssl_private_decrypt(base64_decode($eb64_cry), $decrypted, $private_key);
        if (!$return_de) {
            throw new InvalidRequestException('解密失败,请检查RSA秘钥');

        }

        return $decrypted;
    }
}
