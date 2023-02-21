<?php

namespace App\Modules\Admin\Dao;

use App\Modules\Admin\Model\CircleModel;

class CircleDao extends CircleModel
{

    public function add(\Hyperf\Utils\Collection $params)
    {
        return $this->create($params->toArray());
    }

    public function edit(int $id, \Hyperf\Utils\Collection $params)
    {
        $dao = $this->where('id', $id)->first();
        $dao->fill($params->toArray());
        return $dao->save();
    }

    public function del(int $id){
        $dao = $this->where('id', $id)->first();
        return $dao->delete();
    }
}