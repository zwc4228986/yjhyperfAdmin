<?php

namespace App\Modules\Web\Components\User;

use Hyperf\ViewEngine\Component\Component;
use function Hyperf\ViewEngine\view;

class order extends Component
{
    public function render(): mixed
    {
        return view('components.user.order');
    }
}