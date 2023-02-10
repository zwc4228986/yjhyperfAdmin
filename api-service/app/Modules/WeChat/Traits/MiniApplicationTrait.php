<?php

namespace App\Modules\WeChat\Traits;


use EasyWeChat\MiniApp\Application;

trait MiniApplicationTrait
{
    private $app = null;
    //wx6f9f720b88e739b4
    //ae2f8a7085877d33be07b06c07435cc3
    public function getApp(): Application
    {
        if (is_null($this->app)) {
            $config = [
                'app_id' => 'wx96ed9d6460eb122f',
                'secret' => '8b767d96590c353f57863d093022fd4a',
                'token' => 'youjin',
                'aes_key' => '', // 明文模式请勿填写 EncodingAESKey

                /**
                 * OAuth 配置
                 *
                 * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
                 * callback：OAuth授权完成后的回调页地址
                 */
                'oauth' => [
                    'scopes' => ['snsapi_userinfo'],
                    'callback' => '/examples/oauth_callback.php',
                ],

                /**
                 * 接口请求相关配置，超时时间等，具体可用参数请参考：
                 * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
                 */
                'http' => [
                    'verify_peer' => false,
                    'timeout' => 5.0,
                    // 'base_uri' => 'https://api.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri

                    'retry' => true, // 使用默认重试配置
                    //  'retry' => [
                    //      // 仅以下状态码重试
                    //      'http_codes' => [429, 500]
                    //       // 最大重试次数
                    //      'max_retries' => 3,
                    //      // 请求间隔 (毫秒)
                    //      'delay' => 1000,
                    //      // 如果设置，每次重试的等待时间都会增加这个系数
                    //      // (例如. 首次:1000ms; 第二次: 3 * 1000ms; etc.)
                    //      'multiplier' => 3
                    //  ],
                ],
            ];

            $app = new Application($config);
        } else {
            $app = $this->app;
        }
        return $app;
    }

    public function getToken()
    {
        return $this->getApp()->getAccessToken()->getToken();
    }

}