<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id 
 * @property string $link 
 * @property int $image_id 
 * @property string $title 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property string $delete_time 
 * @property string $video 
 * @property int $is_show 
 */
class Banner extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'banner';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'image_id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'is_show' => 'integer'];
}

