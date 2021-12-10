<?php

namespace App\Models;

use BinaryCats\Sku\Concerns\SkuOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BinaryCats\Sku\HasSku;

class Product extends Model {
    protected $fillable = [
        "name",
        "quantity",
    ];

    use HasFactory;
    use HasSku;

    /**
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
     */
    public function skuOptions() {
        return SkuOptions::make()
            ->from(['label', 'another_field'])
            ->using('_')
            ->forceUnique(false)
            ->generateOnCreate(true)
            ->refreshOnUpdate(false);
    }

}
