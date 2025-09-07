@extends('themes.katalogtoko.layouts.app')

@section('content')
<section class="breadcrumb-section pb-4 pb-md-4 pt-4 pt-md-4">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('products') }} ">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</section>
<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="product-images" class="carousel slide" data-bs-ride="carousel">
                <!--slideshow gambar-->
                    <div class="carousel-inner">
                        @foreach ($product->images as $key => $productImage)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ shop_product_images($productImage) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100">
                            </div>
                        @endforeach
                    </div>
                <!--tombol geser gambar-->
                    <button class="carousel-control-prev" type="button" data-bs-target="#product-images" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#product-images" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <!--tampilan list gambar nyamping-->

                    <ol class="carousel-indicators list-inline">
                        @foreach ($product->images as $key => $productImage)
                            <li class="list-inline-item {{ $key == 0 ? 'active' : '' }}">
                                <a id="carousel-selector-{{ $key }}" data-bs-slide-to="{{ $key }}" data-bs-target="#product-images">
                                    <img src="{{ shop_product_images($productImage) }}" class="img-fluid">
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-detail mt-6 mt-md-0">
                    <h1 class="mb-1">{{ $product->name }}</h1>                
                    <div class="price">
                        <span class="active-price text-dark">Rp {{ $product->price_label }}</span>
                    </div>
                    <hr class="my-6">
                    <div class="product-select mt-3 row justify-content-start g-2 align-items-center">
                        @include ('themes.katalogtoko.shared.flash')
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                        <div class="row">
                            <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid">
                            <a href="https://wa.me/{{ auth()->user()->whatsapp_number ?? '6283845133340' }}" target="_blank" class="btn btn-add-cart">
                                <i class="bx bxl-whatsapp"></i> Pesan via WhatsApp
                            </a>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                    <hr class="my-6">
                    <div class="product-info">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td>SKU:</td>
                                    <td>{{ $product->sku}}</td>
                                </tr>
                                <tr>
                                    <td>Stok:</td>
                                    <td>{{ $product->stock_status_label }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-danger small">
                                        Jika stok produk kosong, pembelian dilakukan secara Pre-order
                                    </td>
                                </tr>
                                <tr>
                                    <td>Spesifikasi</td>
                                    <td>{!! $product->excerpt !!}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <hr class="my-6">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection