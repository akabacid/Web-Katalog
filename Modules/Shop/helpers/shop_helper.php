<?php

use Modules\Shop\Models\ProductImage;

if (!function_exists('shop_product_link')) {
    function shop_product_link($product) {
        $categorySlug = 'produk';

        if ($product->category) {
            $categorySlug = $product->category->slug;
        }

        $productSlug = $product->slug . '-' . $product->sku;

        return route('products.show', [$categorySlug, $productSlug]);
    }
}

if (!function_exists('shop_category_link')) {
    function shop_category_link($category) {
        return route('products.category', [$category->slug]);
    }
}

if (!function_exists('shop_product_images')) {
    function shop_product_images($productImage, $size = 'img-thumb') {
        if (!$productImage) {
            return ProductImage::DEFAULT_IMAGE;
        }

        $image = $productImage->getMedia('products')->first();
        if (!$image) {
            return ProductImage::DEFAULT_IMAGE;
        }

        return $image->getUrl();
    }
}