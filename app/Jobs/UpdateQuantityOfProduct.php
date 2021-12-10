<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateQuantityOfProduct implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;
    protected $sku;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sku,$data, $product) {

        $this->product = $product;
        $this->data = $data;
        $this->sku = $sku;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $data = $this->data;
        $product = $this->product;
        $sku = $this->sku;
        if ($data['operation'] === 'remove') {
            if ($data['quantity'] <= $product['quantity']) {

                $product->update(['quantity' => $product['quantity'] - $data['quantity']]);
                DB::table('movement_of_products')
                    ->insert(
                        [
                            'sku'      => $sku,
                            'quantity' => $data['quantity'],
                            'operation'=> 'remove'
                        ]
                    );
            } else {
                throw new \Error('Valor informado para retirar é maior da quantidade atual!');
            }
        }

        if ($data['operation'] === 'add') {
            if ($data['quantity'] >= 0) {
                $product->update(['quantity' => $product['quantity'] + $data['quantity']]);
                DB::table('movement_of_products')
                    ->insert(
                        [
                            'sku'      => $sku,
                            'quantity' => $data['quantity'],
                            'operation'=> 'add'
                        ]
                    );
            } else {
                throw new \Error('Valor incorreto, verifique se a quantia que deseja adicionar é positiva');
            }
        }

    }
}
