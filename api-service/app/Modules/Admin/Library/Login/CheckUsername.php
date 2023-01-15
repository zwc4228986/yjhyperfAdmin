<?php
/**
 * Created by PhpStorm
 * User: honglin
 * Date: 2022/8/4
 * Time: 上午10:55
 */

namespace App\Modules\Admin\Library\Login;




use App\Modules\Admin\Dao\SystemAdminDao;
use App\Modules\Admin\Library\LoginLibrary;

class CheckUsername
{
    protected $code = LoginCode::USERNAME_IS_EMPTY;

    public function handle(LoginLibrary $body,$next){
        $adminInfo = app(SystemAdminDao::class)->where('username',$body->getUsername())->first();
        if(empty($adminInfo)){
            return $this->code;
        }
        $body->setAdminInfo($adminInfo);
        return $next($body);
    }

}