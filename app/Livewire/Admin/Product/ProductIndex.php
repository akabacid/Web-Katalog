<?php

namespace App\Livewire\Admin\Product;

use Livewire\Attributes\Url;
use Livewire\Component;
use Modules\Shop\Models\Product;

class ProductIndex extends Component
{
    public $perPage = 10;

    #[Url(as: 'q')]
    public ?string $search;

    public function render()
    {
        $products = Product::orderBy('created_at', 'desc');

        if (!empty($this->search)) {
            $products = $products->where('name', 'LIKE', '%'. $this->search . '%');
    }

        if (!empty($this->selectedCategory)) {
            $products = $products->where('category_id', $this->selectedCategory);
        }

        return view('livewire.admin.product.product-index', [
            'products' => $products->paginate($this->perPage),
            'categories' => $this->categories,
        ]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        
        $product->delete();

        session()->flash('success', 'Produk berhasil dihapus!');
    }

    public function changePerPage($perPage)
    {
        if (($perPage < 5) || ($perPage > 25)) {
            $this->perPage = 5;
            return;
        }

        $this->perPage = $perPage;
    }

    #[Url(as: 'category')]
    public $selectedCategory = '';
    public $categories = [];
    public function mount()
    {
        $this->categories = \Modules\Shop\Models\Category::orderBy('name')->get();
    }

}