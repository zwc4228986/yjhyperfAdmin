<?php
namespace YjHyperfAdminPligin\Jwt\Trait;
/**
 * @Notes:【】
 * @Date: 2023-01-15 23:09
 */
trait IdTrait
{
    protected int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id):self
    {
        $this->id = $id;
        return $this;
    }
}