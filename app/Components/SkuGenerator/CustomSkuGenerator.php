<?php
namespace App\Components\SkuGenerator;

use BinaryCats\Sku\Concerns\SkuGenerator;

class CustomSkuGenerator extends SkuGenerator
{
    /**
     * Get the source fields for the SKU.
     *
     * @return string
     */
    protected function getSourceString(): string
    {
        // fetch the source fields
        $source = $this->options->source;
        // Fetch fields from model, skip empty
        $fields = array_filter($this->model->only($source));
        // Fetch fields from the model, if empty, use custom logic to resolve
        if (empty($fields)) {
            return 'add-product-to-cart-example';
        }
        // Impode with a separator
        return implode($this->options->separator, $fields);
    }
}
