<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class EbStoreProductCoupon extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'eb_store_product_coupon';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}