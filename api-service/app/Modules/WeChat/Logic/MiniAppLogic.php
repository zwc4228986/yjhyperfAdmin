<?php
/**
 * @Notes:【】
 * @Date: 2023-02-09 23:00
 */

namespace App\Modules\WeChat\Logic;

use App\Modules\WeChat\Traits\MiniApplicationTrait;

class MiniAppLogic
{
    use MiniApplicationTrait;

    public function code2Session($code)
    {
        dump([
            'appid' => $this->getApp()->getAccount()->getAppId(),
            'secret' => $this->getApp()->getAccount()->getSecret(),
            'grant_type' => 'authorization_code',
            'js_code' => $code,
        ]);
        $data = $this->getApp()->getClient()->get('/sns/jscode2session', [
            'query' => [
                'appid' => $this->getApp()->getAccount()->getAppId(),
                'secret' => $this->getApp()->getAccount()->getSecret(),
                'grant_type' => 'authorization_code',
                'js_code' => $code,
            ]
        ])->toArray();
        dump($data);
        return $data;
    }
}