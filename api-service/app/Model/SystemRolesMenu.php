<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property int $roles_id 
 * @property int $menu_id 
 * @property int $delete_time 
 * @property int $update_time 
 * @property int $create_time 
 */
class SystemRolesMenu extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_roles_menu';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'roles_id' => 'integer', 'menu_id' => 'integer', 'delete_time' => 'integer', 'update_time' => 'integer', 'create_time' => 'integer'];
}
