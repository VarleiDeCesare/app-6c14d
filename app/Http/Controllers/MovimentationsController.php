<?php

namespace App\Http\Controllers;

use App\Models\MovementProduct;
use Spatie\QueryBuilder\QueryBuilder;

class MovimentationsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return QueryBuilder::for(MovementProduct::class)
            ->select('movement_of_products.*')
            ->orderBy('created_at', 'ASC')
            ->get();
    }


}
