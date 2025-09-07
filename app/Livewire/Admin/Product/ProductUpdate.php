<?php

namespace App\Livewire\Admin\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\Category;
use Modules\Shop\Models\ProductImage;
use Modules\Shop\Repositories\Front\Interfaces\ProductRepositoryInterface;

class ProductUpdate extends Component
{
    use WithFileUploads;

    public $id;
    public $stock_status = 'IN_STOCK';
    public Product $product;

    public string $sku, $name, $excerpt, $body, $status;
    public float $price, $sale_price;

    public $image;

    public $categories = [];
    
    public $category_id;

    private $productRepository;

    public function boot(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function mount()
    {
        $this->product = $this->productRepository->findByID($this->id);

         if (!$this->product->category_id) {
        session()->flash('error', 'Produk harus memiliki kategori.');
        return redirect()->route('admin.products.index');
        }

        $this->sku = $this->product->sku;
        $this->name = $this->product->name;
        $this->price = (float) $this->product->price;
        $this->excerpt = (string) $this->product->excerpt;
        $this->body = (string) $this->product->body;
        $this->categories = Category::orderBy('name')->get();
        $this->stock_status = $this->product->stock_status ?? 'IN_STOCK';
        $this->category_id = $this->product->category_id ?? null;
    
    
    }

    protected function rules()
    {
        return [
            'sku' => [
                'required',
                'string',
                Rule::unique('shop_products', 'sku')->ignore($this->product->id),
            ],
            'name' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'excerpt' => [
                'string',
            ],
            'category_id' => [
                'required',
                'exists:shop_categories,id',
            ],
            'stock_status' => ['required', Rule::in(['IN_STOCK', 'OUT_OF_STOCK'])],
        ];
    }

    public function render()
    {
        return view('livewire.admin.product.product-update', [
            'product' => $this->product,
        ]);
    }

    public function update()
    {
        $validated = $this->validate([
            'sku' => [
                'required',
                'string',
                Rule::unique('shop_products', 'sku')->ignore($this->product->id),
            ],
            'name' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'excerpt' => [
                'string',
            ],
            'category_id' => [
                'required',
                'exists:shop_categories,id',
            ],
            'stock_status' => ['required', Rule::in(['IN_STOCK', 'OUT_OF_STOCK'])],
        ]);

        $product = Product::findOrFail($this->product->id);
        $product->update([
            'sku'         => $this->sku,
            'name'        => $this->name,
            'price'       => $this->price,
            'excerpt'     => $this->excerpt,
            'stock_status'=> $this->stock_status,
            'category_id' => $this->category_id,
        ]);
        $product->category_id = $this->category_id;
        $product->save();

        session()->flash('success', 'Produk berhasil diperbarui!');
        return $this->redirectRoute('admin.products.index');
    }

    public function updatedImage()
    {
        $this->validate([
            'image'=> ['required','mimes:webp,jpeg,png,jpg', 'max:4096'],
        ]);
        
        $productImage = ProductImage::create([
            'product_id' => $this->product->id,
            'name' => $this->image->getClientOriginalName(),
        ]);
        
        $productImage->addMedia($this->image)->toMediaCollection('products');

       
    }

    public function setFeaturedImage($id)
    {
        $this->product->featured_image = $id;
        $this->product->save();

        session()->flash('success', 'Foto utama produk berhasil diperbarui!');
    }

    public function deleteImage($imageId)
    {
        $productImage = ProductImage::findOrFail($imageId);
        $productImage->deleteImage(); // Delete media files
        $productImage->delete(); // Delete the database record

        session()->flash('success', 'Foto produk berhasil dihapus!');
    }
}