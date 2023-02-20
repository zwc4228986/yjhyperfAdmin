<?php
/**
 * @Notes:【】
 * @Date: 2023-02-17 23:27
 */

namespace App\Modules\Sign\Logic;

use App\Modules\Sign\Dao\SignTaskDao;
use App\Modules\Sign\Dao\SignTaskLogDao;
use Hyperf\Di\Annotation\Inject;

class SignTaskLogic
{

    #[Inject]
    protected SignTaskDao $signTaskDao;

    #[Inject]
    protected SignTaskLogDao $signTaskLogDao;

    public function lists($params, $user_id = 0)
    {
        $data = $this->signTaskDao->params($params)->get();
        if ($user_id) {
            $data->transform(function ($data) use ($user_id) {
                $finish = $this->signTaskLogDao->getFinishedNum($user_id, $data->code);
                $data->finish = $finish;
                $receive_status = 0;
                if ($finish >= $data->times) {
                    $receive_status = 1;
                }
                if ($this->signTaskDao->isReceive($user_id, $data->code)) {
                    $receive_status = 2;
                }
                dump($data, $receive_status);
                $data->receive_status = $receive_status;
                return $data;
            });
        }

        return $data;
    }
}