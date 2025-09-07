<?php

namespace App\Livewire\Admin\Product;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\Category;
use Illuminate\Support\Str;

class ProductCreate extends Component
{
    public $sku, $name, $category_id;
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function updatedName()
    {
        $this->generateSku();
    }

    public function updatedCategoryId()
    {
        $this->generateSku();
    }

    protected function generateSku()
    {
        if ($this->name && $this->category_id) {
            $category = Category::find($this->category_id);
            $categoryPart = $category ? strtoupper(substr($category->name, 0, 3)) : 'CAT';
            $namePart = strtoupper(preg_replace('/\s+/', '', substr($this->name, 0, 5)));
            $randomPart = strtoupper(Str::random(4));
            $this->sku = $categoryPart . '-' . $namePart . '-' . $randomPart;
        } else {
            $this->sku = '';
        }
    }

    protected function rules()
    {
        return [
            'sku' => [
                'required',
                'string',
                Rule::unique('shop_products', 'sku'),
            ],
            'name' => [
                'required',
                'string',
                Rule::unique('shop_products', 'name'),
            ],
            'category_id' => [
                'required',
                'exists:shop_categories,id',
            ]
        ];
    }

    public function render()
    {
       return view('livewire.admin.product.product-create', [
        'categories' => Category::orderBy('name')->get()
    ]);;
    }

    public function save()
    {
        $params = $this->validate();

        $params['user_id'] = auth()->user()->id;
        $params['slug'] = Str::slug($params['name']);


        if ($product = Product::create($params)) {

            session()->flash('success', 'Produk berhasil dibuat!');
            $this->reset();

            $this->redirectRoute('admin.products.update', ['id' => $product->id]);
            return;
        }

        session()->flash('error', 'Produk gagal dibuat!');

        
    }

    public function close()
    {
        $this->reset();
    }
}
