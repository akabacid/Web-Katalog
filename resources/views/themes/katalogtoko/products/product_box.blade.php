<div class="col-lg-3 col-6">
    <div class="card card-product card-body p-lg-4 p-3">
        <a href="{{ route('products.show', [
            'categorySlug' => $product->category->slug ?? 'uncategorized',
            'productSlug' => $product->slug
        ]) }}">
        <picture>
            <img src="{{ shop_product_images($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </picture>
        </a>
        <h3 class="product-name mt-3">{{ $product->name }}</h3>
        <div class="detail d-flex justify-content-between align-items-center mt-4">
            <p class="price mb-0">Rp {{ $product->price_label }}</p>
        </div>
    </div>
</div>