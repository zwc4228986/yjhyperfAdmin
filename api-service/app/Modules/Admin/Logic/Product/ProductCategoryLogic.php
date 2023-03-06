<?php

namespace App\Modules\Admin\Logic\Product;

use App\Modules\Admin\Dao\CircleCategoryDao;
use App\Modules\Admin\Dao\CircleDao;
use App\Modules\Admin\Dao\ProductCategoryDao;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Collection;

class ProductCategoryLogic
{
    #[Inject]
    protected ProductCategoryDao $productCategoryDao;

    #[Inject]
    protected CircleCategoryDao $circleCategoryDao;

    public function getTreeFormat()
    {
        /** @var Collection $data */
        $datas = $this->circleCategoryDao->with(['Circle' => function ($query) {
            $query->with(['ProductCategory' => function ($query) {
                $query->select('name as label', 'id as value', 'circle_id');
            }]);
        }])->get();

        $datas->transform(function ($data) {
            $data->Circle->transform(function ($item) {
                return [
                    'children' => $item->ProductCategory,
                    'label' => $item->name,
                    'value' => $item->id,
                ];
            });
            return [
                'children' => $data->Circle,
                'label' => $data->name,
                'value' => $data->id,
            ];
        });

//        return $this->circleDao->select('name as label', 'pid', 'id as value')->get();
//        $data = $this->productCategoryDao->newSelf()->select('name as label', 'pid', 'id as value')
//            ->where('is_show', 1)->get()->each(function ($item) {
//                $item->value = $item->value;
//            })->toArray();
//        return Tree($data, 0, 'value', 'pid', 'children');
        return $datas;
    }

    public function lists(array $params = [])
    {

    }

    public function getTreelists($params)
    {
        $data = $this->productCategoryDao->newSelf()->params($params)->setWith('File')->with()->get();

        return Tree($data->toArray(), 0, 'id', 'pid');
    }

    public function delete(int $id)
    {
        if ($this->productCategoryDao->hasChild($id)) {
            return Error('Product category has Child');
        }

        return $this->productCategoryDao->where('id', $id)->delete();
    }

    public function edit($id, \Hyperf\Utils\Collection $params)
    {
        $productCategory = $this->productCategoryDao->where('id', $id)->firstOrError();
        $productCategory->fill($params->toArray());
        return $productCategory->save();
    }

    public function add(Collection $params)
    {
        return $this->productCategoryDao->create($params->toArray());
    }
}