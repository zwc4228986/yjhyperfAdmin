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
namespace App\Model;

use App\Constants\ErrorCode;
use Hyperf\Context\Context;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Db;
use Hyperf\DbConnection\Model\Model as BaseModel;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Collection;

/**
 * @mixin Builder
 * @property int getList
 * @property int firstOrError
 * @method static BaseModel | Collection | LengthAwarePaginatorInterface getList($columns = [], $pageName = 'page', $page = null)
 * @method static BaseModel firstOrError()
 */
abstract class Model extends BaseModel
{
    use SoftDeletes;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    const DELETED_AT = 'delete_time';

    protected ?string $dateFormat = 'U';

    public function scopeGetList(Builder $query, $columns = ['*'], $pageName = 'page', $page = null)
    {

        if (Context::get('is_page', true)) {
            $limit = make(RequestInterface::class)->input('limit', 15);
            return $query->paginate($limit, $columns, $pageName, $page);
        } else {
            Context::set('is_page', false);
            return $query->get($columns);
        }
    }

    public function scopeFirstOrError(Builder $query)
    {
        return $query->firstOr(function () {
            if (Db::transactionLevel() == 0) {
                Error('不存在数据');
            } else {
                throw  new \Exception('不存在数据', ErrorCode::FAIL);
            }
        });
    }

    public function checkAttributes($attribute, $callback, $empty = '')
    {
        if (!is_array($attribute)) {
            $attribute = [$attribute];
        }

        $newAttribute = collect($attribute)->filter(function ($value) {
            return array_key_exists($value, $this->attributes);
        })->map(function ($key) {
            return $this->attributes[$key];
        });
        if ($newAttribute->count() == count($attribute)) {
            return $callback(...$newAttribute->toArray());
        } else {
            return $empty;
        }
    }

}
