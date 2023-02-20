<?php
/**
 * @Notes:【】
 * @Date: 2023-02-17 23:26
 */

namespace App\Modules\Sign\Dao;

use App\Modules\Sign\Model\SignTaskModel;
use Hyperf\Utils\Collection;
use YjHyperfAdminPligin\Framework\Dao\AddWhereQueryTrait;

class SignTaskDao extends SignTaskModel
{
    use AddWhereQueryTrait;

    public function params(Collection $params)
    {
        $_this = $this;
        if ($params->offsetExists('status')) {
            $status = $params->get('status');
            $_this = $this->addWhere($this::query()->where('status', $status));
        }
        return $_this;
    }

    public function isReceive(mixed $user_id, $code)
    {
        return false;
    }
}