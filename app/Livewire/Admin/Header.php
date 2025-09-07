<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Modules\Shop\Models\Product;

class Header extends Component
{
    public $search = '';
    public $suggestions = [];

    public function updatedSearch($value)
    {
        $this->suggestions = [];

       
        $products = Product::where('name', 'LIKE', "%$value%")->get();
        foreach ($products as $product) {
            $this->suggestions[] = [
                'type' => 'Produk',
                'name' => $product->name,
                'id'   => $product->id,
            ];
        }

       
        $categories = \Modules\Shop\Models\Category::where('name', 'LIKE', "%$value%")->get();
        foreach ($categories as $category) {
            $this->suggestions[] = [
                'type' => 'Kategori',
                'name' => $category->name,
                'id'   => $category->id,
            ];
        }
    }

    public function render()
    {
        return view('livewire.admin.header');
    }
}
