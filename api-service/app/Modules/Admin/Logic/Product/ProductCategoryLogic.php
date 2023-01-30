<?php

namespace App\Modules\Admin\Logic\Product;

use App\Modules\Admin\Dao\ProductCategoryDao;
use Hyperf\Di\Annotation\Inject;

class ProductCategoryLogic
{
    #[Inject]
    protected ProductCategoryDao $productCategoryDao;

    public function getTreeFormat()
    {
        $data = $this->productCategoryDao->select('name as label', 'pid', 'id as value')
            ->where('is_show', 1)->get()->each(function ($item) {
                $item->value = $item->value;
            })->toArray();
        return Tree($data, 0, 'value', 'pid', 'children');
    }

    public function lists(array $params=[])
    {
        
    }

    public function getTreelists()
    {
        $data = $this->productCategoryDao->with('File')->get()->toArray();
        return Tree($data, 0, 'id', 'pid');
    }

    public function delete(int $id)
    {
        if($this->productCategoryDao->hasChild($id)){
            return Error('Product category has Child');
        }

        return $this->productCategoryDao->where('id',$id)->delete();
    }

    public function edit($id, \Hyperf\Utils\Collection $params)
    {
        $productCategory = $this->productCategoryDao->where('id',$id)->firstOrError();
        $productCategory->fill($params->toArray());
        return $productCategory->save();
    }
}