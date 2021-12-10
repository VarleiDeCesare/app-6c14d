<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateMovement implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sku;
    protected $operation;
    protected $quantity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sku, $quantity, $operation) {
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->operation = $operation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $sku = $this->sku;
        $quantity = $this->quantity;
        $operation = $this->operation;

        DB::table('movement_of_products')
            ->insert(
                [
                    'sku'      => $sku,
                    'quantity' => $quantity,
                    'operation'=> $operation
                ]
            );
    }
}
