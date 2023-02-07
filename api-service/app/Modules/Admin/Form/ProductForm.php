<?php

namespace App\Modules\Admin\Form;

use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiGet;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use YjHyperfAdminPligin\Form\BaseForm;
use YjHyperfAdminPligin\Form\Column\Column;

#[Api("form/product")]
class ProductForm extends BaseForm
{
    protected $yjCode = 'product';

    function getColumn()
    {
        // TODO: Implement getColumn() method.
        $colum = Column::create();
        $colum->setRules([
            Column::txt()->setLabel('商品ID')->setProp('id'),
            Column::image()->setLabel('商品图')->setProp('image_id'),
            Column::txt()->setLabel('商品名称')->setProp('name')->setWidth('300'),
//            Column::txt()->setLabel('商品类型')->setProp('cate_id'),
            Column::txt()->setLabel('抖币')->setProp('price'),
            Column::txt()->setLabel('商品销量')->setProp('sales'),
            Column::txt()->setLabel('商品库存')->setProp('stock'),
            Column::txt()->setLabel('排序')->setProp('sort'),
            Column::switch()->setUrl($this->createRoute('set-show'))->setLabel('是否显示')->setProp('is_show'),
        ]);
        return $colum->toArray();
    }

    #[ApiPost("config")]
    #[ApiGet("config")]
    function Config()
    {
        // TODO: Implement Config() method.
        $this->_config();
    }


}