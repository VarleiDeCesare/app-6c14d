<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementProduct extends Model {
    use HasFactory;

    protected $fillable = [
        "sku",
        "quantity",
        "operation"
    ];
    protected $table = "movement_of_products";

}
