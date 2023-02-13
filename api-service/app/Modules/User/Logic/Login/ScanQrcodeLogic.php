<?php

namespace App\Modules\User\Logic\Login;


use App\Modules\User\Dao\UserDao;
use App\Modules\User\Dao\UserOpenidDao;
use App\Modules\User\Logic\User\CreateTokenLogic;
use App\Modules\Websocket\Manager\Sender;
use App\Modules\WeChat\Logic\WechatLogic;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;

class ScanQrcodeLogic
{
    #[Inject]
    public Sender $sender;

    #[Inject]
    public UserDao $userDao;

    #[Inject]
    public UserOpenidDao $userOpenidDao;


    public function wechat($openid, $serviceId, $fd)
    {

        $type = 'wechat';
        //判断是否是当前服务器
        //获取uuid
        $wechatUserInfo = app(WechatLogic::class)->getUserInfo($openid);

        $unionid = $wechatUserInfo['unionid'];
        $subscribe_scene = $wechatUserInfo['subscribe_scene'];
        Db::beginTransaction();
        try {
            //是否已经注册
            $userOpenidData = $this->userOpenidDao->getDataByOpenid($type, $openid);

            if (is_null($userOpenidData)) {
                $wechatUserInfo = $this->userOpenidDao->getDataByUnionId($unionid);
                if (is_null($wechatUserInfo)) {
                    $user = $this->userDao->add();
                } else {
                    $user = $this->userDao->read($wechatUserInfo->user_id);
                }
                $this->userOpenidDao->create([
                    'user_id' => $user->id,
                    'unionid' => $unionid,
                    'openid' => $openid,
                    'subscribe_scene' => $subscribe_scene,
                    'type' => $type,
                ]);
                $userId = $user->id;
            } else {
                $userId = $userOpenidData->user_id;
            }

            $token = CreateTokenLogic::init($userId)->create();

            $this->sender->send($fd, 'login_success', ['token' => $token], $serviceId);
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            dd($e->getMessage());
        }
        return $token;
    }


}