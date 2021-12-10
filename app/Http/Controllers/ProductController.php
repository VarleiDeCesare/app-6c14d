<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementProductsRequest;
use App\Models\MovementProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

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

        if ($data['operation'] === 'remove') {
            if ($data['quantity'] <= $product['quantity']) {
                $product->update(['quantity' => $product['quantity'] - $data['quantity']]);
                $dataMovimentation = [
                    "sku"       => $sku,
                    "operation" => 'remove',
                    "quantity"  => $data['quantity']
                ];
                $movimentation = new MovementProduct($dataMovimentation);
                $movimentation->save();

            } else {
                throw new \Error('Valor informado para retirar é maior da quantidade atual!');
            }
        }
        if ($data['operation'] === 'add') {
            if ($data['quantity'] >= 0) {
                $product->update(['quantity' => $product['quantity'] + $data['quantity']]);

                $dataMovimentation = [
                    "sku"       => $sku,
                    "operation" => 'add',
                    "quantity"  => $data['quantity']
                ];

                $movimentation = new MovementProduct($dataMovimentation);
                $movimentation->save();

            } else {
                throw new \Error('Valor incorreto, verifique se a quantia que deseja adicionar é positiva');
            }
        }

        return $product;
    }

}
