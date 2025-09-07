<?php

namespace Modules\Shop\Repositories\Front;

use Modules\Shop\Models\Product;
use Modules\Shop\Repositories\Front\Interfaces\ProductRepositoryInterface;
use Modules\Shop\Models\Category;

class ProductRepository implements ProductRepositoryInterface {

    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $categorySlug = $options['filter']['category'] ?? null;
        $searchQuery = $options['filter']['q'] ?? null;
        $products = Product::with(['category']);
        $sort = $options['sort'] ?? null;

        if ($categorySlug){
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $products = $products->where('category_id', $category->id);
        }

        if ($searchQuery) {
            $products = $products->where(function($query) use ($searchQuery) {
                $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                ->orWhereHas('category', function($q) use ($searchQuery) {
                    $q->where('name', 'LIKE', '%' . $searchQuery . '%');
                });
            });
        }

        if (!empty($options['filter']['price']['min'])) {
            $products = $products->where('price', '>=', $options['filter']['price']['min']);
        }
        if (!empty($options['filter']['price']['max'])) {
            $products = $products->where('price', '<=', $options['filter']['price']['max']);
        }

        if ($sort){
            $products = $products->orderBy($sort['sort'], $sort['order']);
        }

        if ($perPage) {
            return $products->paginate($perPage);
        }

        return $products->get();
    }
    public function findBySlug($slug)
    {
        return Product::where('slug', $slug)->firstOrFail();
    }
    public function findByID($id)
    {
        return Product::where('id', $id)->firstOrFail();
    }
    public function findBySKU($sku)
    {
        return Product::where('sku', $sku)->firstOrFail();
    }
}
?>