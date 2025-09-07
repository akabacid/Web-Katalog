@extends('themes.katalogtoko.shared.layout')

@section('content')
<div class="container mt-5">
    <h1>Search Results</h1>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-lg-3 col-6">
                <div class="card card-body p-lg-4 p3">
                    <a href="#"><img src="{{ shop_product_images($product->images->first()) }}" alt="{{ $product->name }}" class="img-fluid"></a>
                    <h3 class="product-name mt-3">{{ $product->name }}</h3>
                    <p class="price">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection