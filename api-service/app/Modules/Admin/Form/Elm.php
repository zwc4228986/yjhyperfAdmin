<?php

namespace App\Modules\Admin\Form;

use YjHyperfAdminPligin\Form\FormBuilder\Driver\CustomComponent;

class Elm extends \YjHyperfAdminPligin\Form\FormBuilder\Factory\Elm
{

    public static function YjUpload()
    {
        $type = 'YjUpload';
        $component = new CustomComponent($type);
////            $span->action( $this->configValueModel->_get('site_url').'/util/file/upload');
        $component->props(['action' => env('FIEL_URL').'/util/file/upload', 'name' => '上传图片']);
        return $component;
    }

    public static function yjFile()
    {
        $type = 'yjFile';
        $component = new CustomComponent($type);
        $component->props(['action' =>  env('FIEL_URL').'/util/file/upload', 'name' => '上传图片']);
        return $component;
    }

    public static function Ueditor()
    {
        $type = 'Ueditor';
        $component = new CustomComponent($type);
        return $component;
    }

    public static function tinymce()
    {
        $type = 'tinymce';
        $component = new CustomComponent($type);
        return $component;
    }

    public static function wangeditor()
    {
        $type = 'wangeditor';
        $component = new CustomComponent($type);
        return $component;
    }
}