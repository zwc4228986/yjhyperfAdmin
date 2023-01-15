<?php
/**
 * Created by PhpStorm
 * User: honglin
 * Date: 2022/8/4
 * Time: 上午10:55
 */

namespace App\Modules\Admin\Library\Login;



use App\Model\SystemAdmin;
use App\Modules\Admin\Library\LoginLibrary;

class CheckPassword
{
    protected $errCode = LoginCode::PASSWORD;

    public function handle(LoginLibrary $LoginLibrary,$next){
        /** @var SystemAdmin $adminInfo */
        $adminInfo = $LoginLibrary->getAdminInfo();
        if($adminInfo->password == $LoginLibrary->getEncryptPassword()){
            return $next($LoginLibrary);
        }
        return $this->errCode;
    }

}