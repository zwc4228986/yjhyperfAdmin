<?php
/**
 * @Notes:【】
 * @Date: 2023-02-09 23:41
 */

namespace App\Modules\User\Logic\Login;

use App\Modules\User\Dao\UserDao;
use App\Modules\User\Dao\UserOpenidDao;
use App\Modules\User\Logic\User\CreateTokenLogic;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;

class MiniappLogic
{

    #[Inject]
    public UserDao $userDao;

    #[Inject]
    public UserOpenidDao $userOpenidDao;

    public function miniapp($openid, $unionid)
    {
        $type = 'miniapp';
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
                    'type' => $type,
                ]);
                $user_id = $user->id;
            } else {
                $user_id = $userOpenidData->user_id;
            }
            $token = CreateTokenLogic::init($user_id)->create();
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            dd($e->getMessage());
        }
        return compact('token', 'user_id');
    }
}