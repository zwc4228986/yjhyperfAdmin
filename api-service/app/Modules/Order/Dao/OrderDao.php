<?php

namespace App\Modules\Order\Dao;

use App\Model\Order;
use App\Modules\Order\Model\OrderModel;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;
use YjHyperfAdminPligin\Framework\Dao\DaoTrait;

class OrderDao extends OrderModel
{

    use DaoTrait;

    protected array $fillable = [
        'order_sn',
        'user_id',
        'price'
    ];

    public function params(\Hyperf\Utils\Collection $params)
    {
        $params->check('user_id', function ($user_id) {
            $this->addWhere($this::query()->where('user_id', $user_id));
        });
        return $this;
    }

}