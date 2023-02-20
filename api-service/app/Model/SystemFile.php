<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id 
 * @property string $name 
 * @property string $path 
 * @property string $suffix 
 * @property int $tags_id 
 * @property string $size 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property \Carbon\Carbon $create_time 
 * @property string $storage 
 */
class SystemFile extends \App\Model\Trait\SystemFile
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_files';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'tags_id' => 'integer', 'update_time' => 'datetime', 'delete_time' => 'integer', 'create_time' => 'datetime'];

}
