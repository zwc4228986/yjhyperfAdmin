<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id
 * @property string $name
 * @property int $create_time
 * @property int $update_time
 * @property int $delete_time
 */
class Nav extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'nav';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer', 'delete_time' => 'integer'];
}
