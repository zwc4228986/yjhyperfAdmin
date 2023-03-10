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

namespace YjHyperfAdminPligin\Form\FormBuilder\Factory;


use FormBuilder\Driver\CustomComponent;

abstract class Base
{
    /**
     * 创建自定义组件
     *
     * @param string $type
     * @return CustomComponent
     */
    public static function createComponent($type)
    {
        return new CustomComponent($type);
    }
}