<?php
/**
 * @Notes:【】
 * @Date: 2023-01-14 20:46
 */

namespace App\Modules\Admin\Logic;


use App\Modules\Admin\Library\Login\LoginCode;
use App\Modules\Admin\Library\LoginLibrary;

class LoginLogic
{

    public function login($username,$password,$type='password'){
        $loginLibrary = LoginLibrary::init($username,$password,$type);
        $loginLibrary =  $loginLibrary->check();
        if($loginLibrary->code!==LoginCode::SUCCESS){
            Error($loginLibrary->code);
        }
        return $loginLibrary->loginSuccess();
    }
}