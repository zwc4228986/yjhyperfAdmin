<?php

namespace App\Modules\Web\Components;

use App\Modules\Web\Logic\NavLogic;
use App\Modules\Web\Logic\Product\ProductCategoryLogic;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ViewEngine\Component\Component;
use function App\Modules\Web\Helper\getUserID;
use function App\Modules\Web\Helper\isLogin;
use function Hyperf\ViewEngine\view;


class Header extends Component
{
    #[Inject]
    protected ProductCategoryLogic $productCategoryLogic;

    public int $product_category_pid;

    public function __construct(int $productCategoryPid)
    {
        $this->product_category_pid = $productCategoryPid;
    }

    public function render(): mixed
    {
        $nav = $this->productCategoryLogic->lists();
        $isLogin = isLogin();
        dump(Context::get('user_id'));
        $userId = getUserID();
        dump($isLogin, $userId);
        $product_category_pid = $this->product_category_pid;

        return view('components.header', compact('nav', 'isLogin','product_category_pid'));
    }
}