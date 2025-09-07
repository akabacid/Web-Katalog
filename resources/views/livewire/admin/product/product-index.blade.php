<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Daftar Produk
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-product-create">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title mb-0">Kategori:</h3>
                            <select wire:model="selectedCategory" id="categoryFilter" class="form-select ms-3" style="max-width: 300px;" >
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Tampilkan
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" wire:model="perPage" wire:change="changePerPage($event.target.value)" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                                    </div>
                                    Produk
                                </div>
                                <div class="ms-auto text-secondary">
                                    Cari:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>Foto Sampul</th>
                                        <th>Nama Produk</th>
                                        <th class="d-none d-sm-table-cell">Stok</th>
                                        <th class="d-none d-sm-table-cell">Kategori</th>
                                        <th class="d-none d-sm-table-cell">Harga</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>
                                            <span class="avatar me-3" style="background-image: url({{ shop_product_images($product->image) }})"></span>
                                        </td>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $product->stock_status_label }}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ $product->category->name}}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            Rp {{ $product->price}}
                                        </td>
                                        <td class="text-end">
                                            <a class="btn btn-outline-primary btn-sm btn-pill w-20" href="{{ route('admin.products.update', [$product->id]) }}"> Edit </a>
                                            <a wire:click="delete('{{ $product->id }}')" wire:confirm="Are you sure want to delete this?" class="btn btn-outline-danger btn-sm btn-pill w-20" href="#"><span class="danger"> Delete </span></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">
                                            Product is empty.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($products->count() == 0)
                            <div class="alert alert-warning">Tidak ada produk dalam rentang harga ini.</div>
                        @endif
                        <div class="card-footer d-flex align-items-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.product.product-create/>
</div>