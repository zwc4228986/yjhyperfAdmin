<?php

namespace App\View\Components;

use Hyperf\ViewEngine\Component\Component;
use function Hyperf\ViewEngine\view;

class Footer extends Component
{
    public function render(): mixed
    {
        return view('components.footer');
    }
}