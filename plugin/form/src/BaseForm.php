<?php

namespace YjHyperfAdminPligin\Form;

use Hyperf\Utils\Collection;

abstract class BaseForm
{

    protected $yjCode = '';

    public const ADD = false;
    public const EDIT = false;
    public const DELETE = false;

    protected $ops = [
        'lists', 'add', 'edit', 'delete', 'form'
    ];

    public function __construct()
    {
        $this->setRoutes();
    }

    public function setRoutes()
    {
        $this->routes = collect($this->ops)->mapWithKeys(function ($key) {
            if ($key == 'form') {
                return [
                    $key => 'form/' . $this->yjCode . '/' . $key
                ];
            } else {
                return [
                    $key => 'admin/' . $this->yjCode . '/' . $key
                ];
            }
        })->toArray();
    }

    public function createRoute($action)
    {
        return 'admin/' . $this->yjCode . '/' . $action;
    }


    protected function getRoute($types = null)
    {
        if (is_null($types)) {
            return $this->routes;
        }
        return $this->routes[$types];
    }

    abstract function getColumn();

    abstract function Config();

    public function _config()
    {
        $routes = $this->getRoute();
        $column = $this->getColumn();
        $auths = $this->getAuths();
        Success(compact('routes', 'column', 'auths'));
    }

    public function getAuths()
    {
        return [
            'add' => STATIC::ADD,
            'edit' => STATIC::EDIT,
            'delete' => STATIC::DELETE,
        ];
    }

    /**
     * @return Collection
     */
    public function getParams()
    {
        return \Hyperf\Context\Context::get('validator.data');
    }
}