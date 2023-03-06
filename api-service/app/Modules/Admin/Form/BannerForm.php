<?php

namespace App\Modules\Admin\Form;

use App\Modules\Admin\Dao\ProductCategoryDao;
use YjHyperfAdminPligin\Apidog\Annotations\Api;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;
use YjHyperfAdminPligin\Apidog\Annotations\ApiPost;
use YjHyperfAdminPligin\Form\BaseForm;
use YjHyperfAdminPligin\Form\Column\Column;

#[Api("form/banner")]
class BannerForm extends BaseForm
{
    public const DELETE = true;
    public const ADD =  true;

    protected $yjCode = 'banner';

    public function getColumn()
    {
        $colum = Column::create();
        $colum->setRules([
            Column::txt()->setLabel('ID')->setProp('id'),
            Column::txt()->setLabel('标题')->setProp('name'),
            Column::txt()->setLabel('排序')->setProp('sort'),
            Column::switch()->setLabel('状态')->setProp('is_show'),
        ]);
        return $colum->toArray();
    }

    #[ApiPost("config")]
    public function config()
    {
        $this->_config();
    }

    #[ApiPost("update")]
    #[ApiParam("id",'nullable')]
    public function update()
    {

        $id = getParams()->get('id', 0);
        $form = Elm::createForm($this->getRoute($id ? 'edit' : 'add'));

        $form->setRule([
            Elm::input('name', '名称')->required(),
            Elm::number('sort', '排序')->required(),
            Elm::radio('is_show', '状态')->options(function () {
                return [
                    [
                        'label' => '显示',
                        'value' => 1,
                    ],
                    [
                        'label' => '隐藏',
                        'value' => 0,
                    ],
                ];
            })
        ]);

        $id && $form->append(
            Elm::hidden('id', $id)
        );

        $lists = $form->setTitle($id ? '编辑' : '添加' . '商品分类')->formData(function () use ($id) {
            $formData = [];
            if ($id) {
                $formData = app(ProductCategoryDao::class)->where('id', $id)->first();
            }
            return $formData;
        });

        Success(formToData($lists));
    }
}