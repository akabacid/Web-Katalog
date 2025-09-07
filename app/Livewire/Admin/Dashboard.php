<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\Category;

class Dashboard extends Component
{
    public function render()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();

        return view('livewire.admin.dashboard', [
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
        ]);
    }
}
