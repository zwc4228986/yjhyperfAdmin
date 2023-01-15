<?php

namespace App\Modules\Admin\Library;



use App\Dao\System\SystemAdminDao;
use App\Library\Token\SystemAdminCreateTokenLibrary;
use App\Modules\Admin\Library\Login\CheckPassword;
use App\Modules\Admin\Library\Login\CheckUsername;
use App\Modules\User\Logic\User\CreateTokenLogic;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Pipeline;


class LoginLibrary
{

    protected $password;

    protected $username;

    public $code = null;

    protected $type = 'password';

    protected $pipes = [
        CheckUsername::class,
        CheckPassword::class,
    ];

    private $token = null;

    /**
     * @var SystemAdminDao
     */
    protected $adminInfo = null;

    public function __construct($username,$password,$type)
    {
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
    }

    public static function init($username,$password,$type){
        return  new static($username,$password,$type);
    }

    public function check(){
        $code = App(Pipeline::class)->send($this)->through($this->pipes)->then(function($data){
            $this->token = CreateTokenLogic::init($data->getAdminInfo()->id)->create();
            $this->code = 0;
        });
        is_null($this->code) && $this->code = $code;
        return $this;
    }

    /**
     * @return null
     */
    public function getAdminInfo()
    {
        return $this->adminInfo;
    }

    /**
     * @param null $adminInfo
     */
    public function setAdminInfo($adminInfo): void
    {
        $this->adminInfo = $adminInfo;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * 获取加密密码
     * @return mixed
     */
    public function getEncryptPassword()
    {
        return md5($this->password);
    }

    public function loginSuccess()
    {
        return [
            'token'=>$this->token
        ];
    }


}