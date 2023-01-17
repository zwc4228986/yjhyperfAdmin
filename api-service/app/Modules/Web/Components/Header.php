<?php

namespace App\Modules\Web\Components;

use App\Modules\Web\Logic\NavLogic;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ViewEngine\Component\Component;
use function App\Modules\Web\Helper\getUserID;
use function App\Modules\Web\Helper\isLogin;
use function Hyperf\ViewEngine\view;


class Header extends Component
{

    #[Inject]
    protected NavLogic $navLogic;

    public function render(): mixed
    {
        $nav = $this->navLogic->lists();

        $isLogin = isLogin();
        dump(Context::get('user_id'));
        $userId = getUserID();
        dump($isLogin, $userId);
        return view('components.header', compact('nav', 'isLogin'));
    }
}