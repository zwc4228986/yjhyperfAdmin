<?php

namespace YjHyperfAdminPligin\Form;


use Hyperf\Utils\Str;
use Yj\ColumnBuilder\Core\Types\BaseTypes;
use Yj\ColumnBuilder\Core\Types\SwitchTypes;
use Yj\ColumnBuilder\Types\HeaderTypes;
use Yj\ColumnBuilder\Types\SearchTypes;
use Yj\Daos\Search;


/**
 * @method static HeaderTypes header
 * @method static SearchTypes search
 */
class Table
{
    /**
     * @param string $name
     * @param array $arguments
     * @return BaseTypes
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $name = Str::ucfirst($name);
        $name = "\Yj\ColumnBuilder\Types\\{$name}Types";
        return new $name();
    }

}