<?php

namespace App\Modules\Admin;



use Hyperf\Context\Context;

class BaseController
{
    public function getAdminId(){
        return Context::get('admin_id');
    }

    public function getAdminInfo(){
        return Context::get('admin_info');
    }
}