<?php
if (!function_exists('dateFormat')) {
    function dateFormat($timestamp) {
        $seconds = time() - $timestamp;
        if($seconds > 31536000) {
            return date('Y-n-j',$timestamp);
        } elseif($seconds > 2592000) {
            return ceil($seconds / 2592000).'月前';
        } elseif($seconds > 86400) {
            return ceil($seconds / 86400).'天前';
        } elseif($seconds > 3600) {
            return ceil($seconds / 3600).'小时前';
        } elseif($seconds > 60) {
            return ceil($seconds / 60).'分钟前';
        } else {
            return $seconds.'秒前';
        }
    }
}
