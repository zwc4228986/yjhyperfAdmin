<?php

namespace YjHyperfAdminPligin\Generator\Core\Dao;


use App\Model\Model;

/**
 * @Notes: []
 * @User: zwc
 * @Date: 2022/2/28 19:36
 */
class Config extends \Hyperf\Config\Config
{

    /**
     * @return array
     */
    protected function getBaseConfig()
    {
        return [
            'namespace' => 'App\Dao',
            'base_class_name' => Model::class,
        ];
    }


    public function __construct(array $configs)
    {
        $configs = $this->merge($configs, $this->getBaseConfig());
        parent::__construct($configs);
    }

    /**
     * @param array $high
     * @param array $low
     * @return array
     */
    protected function merge(array $high, array $low)
    {
        foreach ($high as $key => $value) {
            if ($value !== null) {
                $low[$key] = $value;
            }
        }

        return $low;
    }


}