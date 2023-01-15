<?php
/**
 * @Notes:【】
 * @Date: 2023-01-14 20:46
 */

namespace App\Modules\Admin\Logic;

use App\Library\Login\LoginCode;
use App\Library\Login\LoginLibrary;

class LoginLogic
{
    public function login($username,$password,$type='password'){
        $loginLibrary = LoginLibrary::init($username,$password,$type);
        $loginLibrary =  $loginLibrary->check();
        if($loginLibrary->code!==LoginCode::SUCCESS){
            _Error((LoginCode::getMessage($loginLibrary->code)));
        }
        return $loginLibrary->loginSuccess();
    }
}