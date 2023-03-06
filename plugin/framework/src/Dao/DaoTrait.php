<?php

namespace YjHyperfAdminPligin\Framework\Dao;


use Hyperf\Database\Model\Builder;

trait DaoTrait
{

    private $daoquery = null;

    private $init = false;

    protected function init()
    {
        $this->init = true;

        return $this;
    }


    protected $daoWith = [];

    public function newSelf(): self
    {
        return (new self())->init();
    }

    public function addWhere(\Hyperf\Database\Model\Builder $query): self
    {
        if ($this->init == false) {
            Error('init is false');
        }

        $this->getDaoquery()->getQuery()->addNestedWhereQuery($query->getQuery());

        return $this;
    }

    public function setWith($with)
    {
        if ($this->init == false) {
            Error('init is false');
        }
        $this->daoWith = $with;
        return $this;
    }

    public function daoWith($with)
    {
        if ($this->init == false) {
            Error('init is false');
        }
        $this->daoWith = $with;
        return $this;
    }

    public function __call($method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return $this->{$method}(...$parameters);
        }

        return $this->getDaoquery()->with($this->daoWith)->{$method}(...$parameters);
    }


    public function getDaoquery(): Builder
    {
        if ($this->daoquery == null) {
            $this->setDaoquery($this->newQuery());
        }
        return $this->daoquery;
    }

    public function setDaoquery(Builder $daoquery): self
    {
        $this->daoquery = $daoquery;
        return $this;
    }

    public function getQuery()
    {
        return $this::query();
    }

}