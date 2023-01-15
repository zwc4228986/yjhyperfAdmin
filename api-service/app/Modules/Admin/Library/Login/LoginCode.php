<?php
/**
 * Created by PhpStorm
 * User: honglin
 * Date: 2022/8/4
 * Time: 上午10:34
 */

namespace App\Modules\Admin\Library\Login;


use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class LoginCode extends \Hyperf\Constants\AbstractConstants
{
    /**
     * @Message('登录成功')
     */
    const SUCCESS = 0;
    /**
     * @Message("余额")
     */
    const PASSWORD = 1;

    /**
     * @Message("用户名不存在")
     */
    const USERNAME_IS_EMPTY = 2;

    /**
     * @Message("设置token失败")
     */
    const SET_TOKEN = 3;

}