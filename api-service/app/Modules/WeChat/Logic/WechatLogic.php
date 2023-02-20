<?php

namespace App\Modules\WeChat\Logic;

use App\Modules\WeChat\Logic\Handler\ScanQrcodeLoginHandler;
use App\Modules\WeChat\Traits\ApplicationTrait;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Snowflake\IdGeneratorInterface;
use Hyperf\Utils\Collection;
use function Swoole\Coroutine\Http\request;

class WechatLogic
{
    use ApplicationTrait;

    #[Inject]
    protected ScanQrcodeLoginHandler $scanQrcodeLoginHandler;


    #[Inject]
    protected ClientFactory $clientFactory;

    private $url = '/cgi-bin/qrcode/create';
    private $showqrcodeUrl = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';


    public function qrcode($scene_str = '')
    {
        if($scene_str === ''){
            $generator = make(IdGeneratorInterface::class);
            $scene_str =  (string)$generator->generate();
        }

        $data =  $this->getApp()->getClient()->postJson($this->url, [
            "expire_seconds" => 604800, "action_name" => "QR_STR_SCENE", "action_info" => ["scene" => ["scene_str" => $scene_str]]
        ]);
        $data = json_decode($data,true);
        return [
            'scene_str'=>$scene_str,
            'image'=>$this->showqrcodeUrl.urlencode($data['ticket'])
        ];
    }

    public function getUserInfo(string $openid){
        return $this->getApp()->getClient()->get('/cgi-bin/user/info',[
            'openid' => $openid,
            'lang'=>'zh_CN',
        ])->toArray();
    }

    public function service()
    {
        $server = $this->getApp()->setRequest(make(RequestInterface::class))->getServer();
        $server->with($this->scanQrcodeLoginHandler);
//        $server->with(function($message, \Closure $next) {
//            dump($message);
//            // 你的自定义逻辑
//            return '感谢你使用 抖资源';
//        });

        return $server->serve();
    }

    public function menuCreate($data)
    {
        dump($data);
        return $this->getApp()->getClient()->postJson('cgi-bin/menu/create',['button'=>$data])->getContent();
    }

    public function menuGet()
    {
        return $this->getApp()->getClient()->get('cgi-bin/get_current_selfmenu_info')->getContent();
    }


}