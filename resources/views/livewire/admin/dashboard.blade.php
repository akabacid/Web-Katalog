<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h1 mb-2">{{ $categoryCount }}</div>
                            <div class="text-secondary">Kategori</div>
                            <a wire:navigate href="/admin/categories" class="btn btn-primary mt-2">Kelola Kategori</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h1 mb-2">{{ $productCount }}</div>
                            <div class="text-secondary">Produk</div>
                            <a wire:navigate href="/admin/products" class="btn btn-primary mt-2">Kelola Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>