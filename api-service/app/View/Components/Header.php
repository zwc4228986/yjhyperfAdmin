<?php

namespace App\View\Components;

use Hyperf\ViewEngine\Component\Component;
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
        return view('components.header',compact('nav'));
    }
}