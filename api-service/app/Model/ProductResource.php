<?php

declare(strict_types=1);

namespace App\Model;

class ProductResource extends \App\Model\Trait\ProductResource
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_resource';

    /**
     * The connection name for the model.
     */
    protected ?string $connection = 'default';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
