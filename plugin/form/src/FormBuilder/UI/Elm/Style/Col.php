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

namespace  YjHyperfAdminPligin\Form\FormBuilder\UI\Elm\Style;


use  YjHyperfAdminPligin\Form\FormBuilder\Contract\ColComponentInterface;

/**
 * col栅格规则
 *
 * Class Col
 * @package FormBuilder\Style
 */
class Col implements ColComponentInterface
{
    protected $rule;

    public function __construct(array $rule = [])
    {
        $this->rule = $rule;
    }

    /**
     * 栅格的占位格数，可选值为0~24的整数，为 0 时，相当于display:none
     *
     * @param int|string $span
     * @return $this
     */
    public function span($span)
    {
        $this->rule['span'] = $span;
        return $this;
    }

    /**
     * 设置表单域 label 的宽度
     *
     * @param int|string $labelWidth
     * @return $this
     */
    public function labelWidth($labelWidth)
    {
        $this->rule['labelWidth'] = $labelWidth;
        return $this;
    }

    /**
     * 栅格左侧的间隔格数，间隔内不可以有栅格
     *
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->rule['offset'] = $offset;
        return $this;
    }

    /**
     * 栅格向右移动格数
     *
     * @param $push
     * @return $this
     */
    public function push($push)
    {
        $this->rule['push'] = $push;
        return $this;
    }

    /**
     * 栅格向左移动格数
     *
     * @param $pull
     * @return $this
     */
    public function pull($pull)
    {
        $this->rule['pull'] = $pull;
        return $this;
    }

    /**
     * 自定义元素标签
     *
     * @param string $tag
     * @return $this
     */
    public function tag($tag)
    {
        $this->rule['tag'] = (string)$tag;
        return $this;
    }

    /**
     * <768px 响应式栅格，可为栅格数或一个包含其他属性的对象
     *
     * @param int|self $xs
     * @return $this
     */
    public function xs($xs)
    {
        $this->rule['xs'] = $this->buildGrid($xs);
        return $this;
    }

    /**
     * ≥768px 响应式栅格，可为栅格数或一个包含其他属性的对象
     *
     * @param int|self $sm
     * @return $this
     */
    public function sm($sm)
    {
        $this->rule['sm'] = $this->buildGrid($sm);
        return $this;
    }

    /**
     * ≥992px 响应式栅格，可为栅格数或一个包含其他属性的对象
     *
     * @param int|self $md
     * @return $this
     */
    public function md($md)
    {
        $this->rule['md'] = $this->buildGrid($md);
        return $this;
    }

    /**
     * ≥1200px 响应式栅格，可为栅格数或一个包含其他属性的对象
     *
     * @param int|self $lg
     * @return $this
     */
    public function lg($lg)
    {
        $this->rule['lg'] = $this->buildGrid($lg);
        return $this;
    }

    protected function buildGrid($grid)
    {
        return $grid instanceof self ? $grid->getCol() : (int)$grid;
    }

    /**
     * @return object
     */
    public function getCol()
    {
        return (object)$this->rule;
    }

}