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
namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Controller;
use YjHyperfAdminPligin\Apidog\Annotation\Api;
use YjHyperfAdminPligin\Apidog\Annotation\ApiPost;

#[Api(prefix: 'index')]
class IndexController extends AbstractController
{
    #[ApiPost(path: 'index')]
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }
}
