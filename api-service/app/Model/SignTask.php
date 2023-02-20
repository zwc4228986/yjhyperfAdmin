<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id 
 * @property string $name 
 * @property int $status 
 * @property string $code 
 * @property int $point 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 * @property int $times 
 * @property string $remark 
 * @property string $button_text 
 * @property int $type 
 * @property string $url 
 * @property string $event 
 */
class SignTask extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'sign_task';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'status' => 'integer', 'point' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'times' => 'integer', 'type' => 'integer'];
}
