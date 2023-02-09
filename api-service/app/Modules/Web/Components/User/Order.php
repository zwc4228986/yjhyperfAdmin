<?php

namespace App\Modules\Web\Components\User;

use App\Modules\Order\Logic\OrderLogic;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Collection;
use Hyperf\ViewEngine\Component\Component;
use function App\Modules\Web\Helper\getUserID;
use function Hyperf\ViewEngine\view;

class Order extends Component
{
    #[Inject]
    protected OrderLogic $orderLogic;

    public function render(): mixed
    {
        $userId = getUserID();
        $order = $this->orderLogic->lists(collect(['user_id' => $userId]));
        dump($order);
        return view('components.user.order',compact('order'));
    }
}