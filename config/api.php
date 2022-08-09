<?php

return [
    // 百度服务
    'baidu'    => [
        // 翻译
        'translate' => [
            'appid' => env('BAIDU_TRANSLATE_APPID'),
            'key'   => env('BAIDU_TRANSLATE_KEY'),
        ],
        // OCR
        'ocr'       => [
            'client_id'     => env('BAIDU_CLIENT_ID'),
            'client_secret' => env('BAIDU_CLIENT_SECRET'),
        ],

    ],

    // 腾讯服务

    // 阿里服务

    // 企查查
    'qichacha' => [
        'key'        => env('QICHACHA_KEY'),
        'secret_key' => env('QICHACHA_SECRET_KEY'),
    ],
];
