<?php

namespace App\Modules\Admin\Library;



use App\Modules\Admin\Dao\SystemAdminDao;
use App\Modules\Admin\Library\Login\CheckPassword;
use App\Modules\Admin\Library\Login\CheckUsername;
use App\Modules\User\Logic\User\CreateTokenLogic;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Pipeline;
use YjHyperfAdminPligin\Jwt\Jwt;


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

    #[Inject]
    protected Jwt $jwt;

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
            $this->token = $this->jwt->guard('admin')->encode($data->getAdminInfo()->id)->get();
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