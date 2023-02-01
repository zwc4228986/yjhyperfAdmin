<?php

namespace App\Modules\Web\Components;

use App\Modules\Web\Logic\NavLogic;
use App\Modules\Web\Logic\Product\ProductCategoryLogic;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Paginator\LengthAwarePaginator;
use Hyperf\ViewEngine\Component\Component;
use function App\Modules\Web\Helper\getUserID;
use function App\Modules\Web\Helper\isLogin;
use function Hyperf\ViewEngine\view;


class Page extends Component
{

    private LengthAwarePaginator $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function render(): mixed
    {

        $elements = $this->page->elements();
        return view('components.bootstrap', ['paginator' => $this->page, 'elements' => $elements]);
    }
}