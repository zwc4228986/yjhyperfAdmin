<?php

namespace App\Modules\Utils\Captcha\Logic;

use App\Modules\Utils\Captcha\Library\CaptchaLibrary;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class CaptchaLogic
{
    public function build($length = 4){
        return CaptchaLibrary::init()->build($length);
    }
}