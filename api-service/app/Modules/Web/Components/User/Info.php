<?php

namespace App\Modules\Web\Components\User;

use App\Modules\User\Logic\User\UserLogic;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ViewEngine\Component\Component;
use function App\Modules\Web\Helper\getUserID;
use function Hyperf\ViewEngine\view;

class Info extends Component
{
    #[Inject]
    protected UserLogic $userLogic;

    public function render(): mixed
    {
        $userId = getUserID();
        $userDetail = $this->userLogic->detail($userId);

        return view('components.user.info',compact('userDetail'));
    }
}