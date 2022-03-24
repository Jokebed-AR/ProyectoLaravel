<?php

namespace App\Observers;

use App\Models\Option;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        if ($product->has_variants) {
            if ($product->variants != null) {
                $variants =json_decode($product->variants);
                foreach ($variants as $variant) {
                    $variant->product_id = $product->id;
                    $productVariant = ProductVariant::create( (array) $variant);

                    foreach ($variant->options as $option) {
                        $option->product_variant_id = $productVariant->id;
                        ProductVariantOption::create((array) $option);
                    }
                }
            }
        }
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        if ($product->has_variants) {
            if (isset($product->variants)) {
                if ($product->variants != null) {
                    $variants =json_decode($product->variants);
                    $idToUpdate = [];
                    foreach ($variants as $variant){
                        if(isset($variant->id))
                            $idToUpdate[] = $variant->id;
                    }
                    $productVariants = $product->productVariants()->pluck('id')->toArray();
                    ProductVariantOption::whereIn('product_variant_id', $productVariants)->delete();
                    $product->productVariants()->whereNotIn('id', $idToUpdate)->delete();

                    foreach ($variants as $variant) {
                        $variant->product_id = $product->id;
                        $productVariant = null;
                        if(isset($variant->id))
                        {
                            $productVariant = ProductVariant::find($variant->id);
                            $productVariant->update( (array) $variant);
                        }
                        if($productVariant == null)
                        {
                            $productVariant = ProductVariant::create( (array) $variant);

                        }


                        foreach ($variant->options as $option) {
                            $option->product_variant_id = $productVariant->id;
                            ProductVariantOption::create((array) $option);
                        }
                    }
                }
            }
        }
    }
}
