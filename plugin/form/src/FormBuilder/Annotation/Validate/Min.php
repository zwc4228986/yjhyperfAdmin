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

namespace YjHyperfAdminPligin\Form\FormBuilder\Annotation\Validate;


/**
 * @Annotation
 */
final class Min extends ValidateAnnotation
{
    /**
     * @Required
     */
    public $value;


    public function parseRule($rule)
    {
        $rule = $this->tidyValidate($rule);
        $rule['validate'][] = ['min' => $this->value, 'type' => $this->type, 'trigger' => $this->trigger, 'message' => $this->message];
        return $rule;
    }

    public function parseComponent($component)
    {
        $component->appendValidate($component->createValidate()->min($this->value)->message($this->message));
        return $component;
    }
}