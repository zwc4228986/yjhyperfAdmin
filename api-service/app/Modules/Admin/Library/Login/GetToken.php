<?php
/**
 * Created by PhpStorm
 * User: honglin
 * Date: 2022/8/4
 * Time: 上午10:55
 */

namespace App\Library\Login;

use App\Model\Dao\System\SystemAdminDao;

class GetToken
{
    protected $errCode = LoginCode::SET_TOKEN;

    public function handle(LoginLibrary $LoginLibrary,$next){

        return $next($LoginLibrary);
    }

}