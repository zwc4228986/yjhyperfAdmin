<?php
/**
 * PHP表单生成器
 *
 * @package  FormBuilder
 * @author   xaboy <xaboy2005@qq.com>
 * @version  2.0
 * @license  MIT
 * @link     https://github.com/xaboy/form-builder
 * @document http://php.form-create.com
 */

namespace  YjHyperfAdminPligin\Form\FormBuilder\UI\Elm\Components;


use  YjHyperfAdminPligin\Form\FormBuilder\Contract\ValidateInterface;
use  YjHyperfAdminPligin\Form\FormBuilder\Driver\CustomComponent;
use  YjHyperfAdminPligin\Form\FormBuilder\Driver\FormComponent;
use  YjHyperfAdminPligin\Form\FormBuilder\Factory\Elm;
use  YjHyperfAdminPligin\Form\FormBuilder\Util;

/**
 * 数组组件
 *
 * Class Group
 * @method $this min(int $min) 最少几项
 * @method $this max(int $max) 最多几项
 * @method $this disabled(bool $bool) 是否禁用
 */
class Group extends FormComponent
{
    protected $defaultValue = [];

    protected static $propsRule = [
        'min' => 'string',
        'max' => 'string',
        'disabled' => 'int',
    ];

    /**
     * @param array|CustomComponent $rule
     * @return $this
     */
    public function rule($rule)
    {
        $this->props['rule'] = $this->tidyRule([$rule])[0];
        return $this;
    }

    /**
     * @param array $rules
     * @return array
     */
    protected function tidyRule(array $rules)
    {
        foreach ($rules as $k => $rule) {
            if (Util::isComponent($rule)) {
                $rules[$k] = $rule->build();
            }
        }
        return $rules;
    }

    public function rules(array $rules)
    {
        $this->props['rules'] = $this->tidyRule($rules);
        return $this;
    }

    /**
     * @return ValidateInterface
     */
    public function createValidate()
    {
        return Elm::validateArr();
    }
}