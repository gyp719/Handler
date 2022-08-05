<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text, $from = 'auto', $to = 'en'): string
    {
        // 实例化 HTTP 客户端
        $http = new Client;

        // 初始化配置信息
        $api   = 'https://fanyi-api.baidu.com/api/trans/vip/translate?';
        $appid = config('api.baidu.translate.appid');
        $key   = config('api.baidu.translate.key');
        $salt  = time();

        // 如果没有配置百度翻译，自动使用兼容的拼音方案
        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        // 根据文档，生成 sign
        // http://api.fanyi.baidu.com/api/trans/product/apidoc
        // appid+q+salt+密钥 的MD5值
        $sign = md5($appid.$text.$salt.$key);

        // 构建请求参数
        $query = http_build_query([
            "q"     => $text, // 请求翻译文本，为保证翻译质量，请将单次请求长度控制在 6000 bytes以内。（汉字约为2000个）
            "from"  => $from, // 翻译源语言
            "to"    => $to, // 译文语言
            "appid" => $appid,
            "salt"  => $salt,
            "sign"  => $sign,
        ]);


        // 发送 HTTP Get 请求
        $response = $http->get($api.$query);

        $result = json_decode($response->getBody(), true);

        /**
        获取结果，如果请求成功，dd($result) 结果如下：
        array:3 [▼
            "from" => "zh"
            "to" => "en"
            "trans_result" => array:1 [▼
                0 => array:2 [▼
                    "src" => "XSS 安全漏洞" // 原文
                    "dst" => "XSS security vulnerability" // 译文
                ]
            ]
        ]
         **/

        // 尝试获取获取翻译结果
        if (isset($result['trans_result'][0]['dst'])) {
            return Str::slug($result['trans_result'][0]['dst']);
        } else {
            // 如果百度翻译没有结果，使用拼音作为后备计划。
            return $this->pinyin($text);
        }
    }

    public function pinyin($text): string
    {
        return Str::slug(app(Pinyin::class)->permalink($text));
    }
}
