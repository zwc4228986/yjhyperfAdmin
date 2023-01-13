<?php

namespace App\Modules\Web\Components;

use Hyperf\Context\Context;
use Hyperf\ViewEngine\Component\Component;
use function App\Modules\Web\Helper\getUserID;
use function App\Modules\Web\Helper\isLogin;
use function Hyperf\ViewEngine\view;


class Header extends Component
{
    public function render(): mixed
    {
        $nav = [
            ['name'=>'PPT'],
            ['name'=>'合同'],
            ['name'=>'字体'],
        ];
        $isLogin = isLogin();
        dump(Context::get('user_id'));
        $userId = getUserID();
        dump($isLogin,$userId);
        return view('components.header',compact('nav','isLogin'));
    }
}