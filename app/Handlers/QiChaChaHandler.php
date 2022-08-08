<?php

namespace App\Handlers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class QiChaChaHandler
{
    public $key;
    public $secret;
    public Http $http;

    public function __construct()
    {
        $this->key    = config('api.qichacha.key');
        $this->secret = config('api.qichacha.secret_key');
    }

    private function getToken($timeSpan): string
    {
        return strtoupper(md5($this->key.$timeSpan.$this->secret));
    }

    // 税务登记号核验 - 纳税人识别号&开户行
    public function getQiChaChaApiECICreditCode($keyWord)
    {
        $timeSpan = time();
        $url      = 'https://api.qichacha.com/ECICreditCode/GetCreditCodeNew';
        $response = Http::withHeaders([
            'Token'    => $this->getToken($timeSpan),
            'Timespan' => $timeSpan,
        ])->get($url, [
            'key'     => $this->key,
            'keyWord' => $keyWord,
        ]);

        try {
            return $response->throw();
        } catch (RequestException $e) {
            logger('[税务登记号核验] '.$e->getMessage());
        }

        return $response->json();
    }

    // 企业工商详情
    public function getQiChaChaApiECIInfoVerify($keyWord)
    {
        $timeSpan = time();
        $url      = 'https://api.qichacha.com/ECIInfoVerify/GetInfo';
        $response = Http::withHeaders([
            'Token'    => $this->getToken($timeSpan),
            'Timespan' => $timeSpan,
        ])->get($url, [
            'key'       => $this->key,
            'searchKey' => $keyWord,
        ]);

        try {
            return $response->throw();
        } catch (RequestException $e) {
            logger('[企业工商详情] '.$e->getMessage());
        }

        return $response->json();
    }

}
