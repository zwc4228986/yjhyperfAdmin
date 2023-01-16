<?php
namespace  YjHyperfAdminPligin\Framework\Dao;


use Hyperf\Database\Query\Builder;

trait AddWhereQueryTrait
{

    private $daoquery = null;

    public function newSelf(){
        return (new self());
    }

    public function addWhere(\Hyperf\Database\Model\Builder $query):self
    {
        if($this->daoquery == null){
            return $this->newSelf()->setDaoquery($this->newQuery()->getQuery())->addWhere($query);
        }
        $this->getDaoquery()->addNestedWhereQuery($query->getQuery());
        return $this;
    }


    public function __call( $method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return $this->{$method}(...$parameters);
        }
        return $this->getDaoquery()->{$method}(...$parameters);
    }


    public function getDaoquery():Builder
    {
        if($this->daoquery == null){
            return $this->newQuery()->getQuery();
        }
        return $this->daoquery;
    }


    public function setDaoquery(Builder $daoquery): self
    {
        $this->daoquery = $daoquery;
        return $this;
    }

}