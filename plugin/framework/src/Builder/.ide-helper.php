<?php

namespace Hyperf\Database\Model {
    /**
     * @method $this whereHasIn(string $relation, ?\Closure $callable = null)
     * @method $this whereHasJoin(string $relation, ?\Closure $callable = null)
     * @method $this yjwhere(string $relation, ?\Closure $callable = null)
     * @method $this yjwhereIn(string $relation, ?\Closure $callable = null)
     * @method $this yjwhereBetween(string $relation, ?\Closure $callable = null)
     * @method $this yjOrderByDesc(string $relation)
     * @method $this yjselect(string $relation, ?\Closure $callable = null)
     * @method $this orWhereHasIn(string $relation, ?\Closure $callable = null)
     * @method $this whereHasNotIn(string $relation, ?\Closure $callable = null)
     * @method $this orWhereHasNotIn(string $relation, ?\Closure $callable = null)
     * @method $this whereHasMorphIn(string $relation, $types, ?\Closure $callable = null)
     * @method $this orWhereHasMorphIn(string $relation, $types, ?\Closure $callable = null)
     * @method $this yjRangeTime(string $field, $types)
     */
    class Builder extends \Hyperf\Database\Query\Builder
    {

    }
}
