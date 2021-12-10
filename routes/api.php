<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::resources([
    'products' => ProductController::class,
]);
