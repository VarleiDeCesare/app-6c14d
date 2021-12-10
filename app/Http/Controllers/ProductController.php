<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementProductsRequest;
use App\Jobs\UpdateQuantityOfProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return "porra";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $product = new Product($request->all());
        $product->save();
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovementProductsRequest $request, $sku) {
        $data = $request->all();
        $product = Product::where('sku', $sku)->first();

        UpdateQuantityOfProduct::dispatch($sku, $data,$product);


        return $product;
    }

}
