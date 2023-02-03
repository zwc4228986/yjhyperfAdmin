<?php

namespace App\Modules\Order\Dao;

use App\Model\Order;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;

class OrderDao extends Order
{

    use AddWhereQueryTrait;

    protected array $fillable = [
        'order_sn',
        'user_id',
        'price'
    ];

    public function params(\Hyperf\Utils\Collection $params)
    {
        $_this = $this;
        if($params->offsetExists('user_id')){
            $user_id = $params->get('user_id');
            $_this = $this->addWhere($this::query()->where('user_id', $user_id));
        }
        return $_this;
    }

}