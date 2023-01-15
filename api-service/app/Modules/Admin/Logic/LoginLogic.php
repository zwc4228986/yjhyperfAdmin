<?php
/**
 * @Notes:【】
 * @Date: 2023-01-14 20:46
 */

namespace App\Modules\Admin\Logic;

<<<<<<< HEAD

use App\Modules\Admin\Library\Login\LoginCode;
use App\Modules\Admin\Library\LoginLibrary;
=======
use App\Library\Login\LoginCode;
use App\Library\Login\LoginLibrary;
>>>>>>> 1ff3589 (我我)

class LoginLogic
{
    public function login($username,$password,$type='password'){
        $loginLibrary = LoginLibrary::init($username,$password,$type);
        $loginLibrary =  $loginLibrary->check();
        if($loginLibrary->code!==LoginCode::SUCCESS){
<<<<<<< HEAD
            Error($loginLibrary->code);
=======
            _Error((LoginCode::getMessage($loginLibrary->code)));
>>>>>>> 1ff3589 (我我)
        }
        return $loginLibrary->loginSuccess();
    }
}