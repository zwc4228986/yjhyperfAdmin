<?php

use App\Constants\ErrorCode;
use App\Exception\YjException;
use Hyperf\Context\Context;

if (!function_exists('Tree')) {
    function Tree($array, $val = 0, $id = 'id', $pid = 'pid', $child = 'children')
    {
        $array = collect($array)->toArray();

        if (empty($array)) {
            return [];
        }
        $tree = [];
        foreach ($array as $key => $v) {
            $tree[$v[$id]] = &$array[$key];
        }

        $tree1 = [];
        foreach ($array as $key => $v) {
            if ($v[$pid] == $val) {
                $tree1[] = &$array[$key];
            } else {
                if (isset($tree[$v[$pid]])) {
                    $tree[$v[$pid]][$child][] = &$array[$key];
                }
            }
        }
        return $tree1;
    }
}
