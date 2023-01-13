<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\View\Mode;

return [
    'engine' =>  Hyperf\ViewEngine\HyperfViewEngine::class,
    'mode' => Mode::SYNC,
    'config' => [
        'view_path' => BASE_PATH . '/app/Modules/Web/View',
        'cache_path' => BASE_PATH . '/runtime/view/',
    ],
    'components' => [
        'footer' => \App\Modules\Web\Components\Footer::class,
        'header' => \App\Modules\Web\Components\Header::class,
    ],
];
