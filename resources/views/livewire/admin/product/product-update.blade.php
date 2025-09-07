<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Produk
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span>
                            <a href="/admin/products" wire:navigate class="btn btn-white">
                               Kembali
                            </a>
                        </span>
                        <button wire:click="update" class="btn btn-primary d-sm-inline-block" type="button">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-8">
                    <div class="mb-3">
                        <em style="color:red"><span>Tanda (*) wajib diisi</span></em>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Produk</h3>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-warning">
                                    <div class="alert-title">Whoops!</div>
                                    There are some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <div class="mb-3">
                                    <label class="form-label required">SKU</label>
                                    <div>
                                        <input wire:model="sku" type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" disabled />
                                        <small class="form-hint">
                                            Kode unik produk dibuat secara otomatis, tidak perlu diisi.
                                        </small>
                                        @error('sku')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Nama</label>
                                    <div>
                                        <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" />
                                        <small class="form-hint">
                                            slug : /product/{{ $product->slug }}
                                        </small>
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Kategori</label>
                                    <select wire:model="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                     <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Keterangan / Spesifikasi</label>
                                    <textarea wire:model="excerpt" class="summernote form-control @error('excerpt') is-invalid @enderror"></textarea>
                                    @error('excerpt')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Harga</label>
                                
                                    <div class="input-group">
                                        <span class="input-group-text text-black">Rp</span>
                                        <input wire:model="price" type="number" data-by-field="amount" class="form-control @error('price') is-invalid @enderror" name="price"/>
                                    </div>
                                    <em>Isi dengan angka tanpa titik dan koma</em>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Produk</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image" />
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                        <label class="form-label required">Foto Produk</label>
                                        <small class="form-hint mb-3">
                                            Klik salah satu sebagai foto sampul.
                                        </small>
                                        <div class="row g-2">
                                            @foreach ($product->images as $productImage)
                                            <div class="col-6 col-sm-2">
                                                <label class="form-imagecheck mb-2">
                                                    <input wire:click="setFeaturedImage('{{ $productImage->id }}')" name="form-imagecheck-radio" type="radio" {{ ($product->featured_image == $productImage->id) ? 'checked' : ''}} value="1" class="form-imagecheck-input">
                                                    <span class="form-imagecheck-figure">
                                                        <img src="{{ shop_product_images($productImage) }}" alt="{{ $productImage->name }}" class="form-imagecheck-image">
                                                    </span>
                                                </label>
                                                <button wire:click="deleteImage('{{ $productImage->id }}')" class="btn btn-danger btn-sm mt-2">Hapus</button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label">Status Produk</label>            
                                            <select wire:model="stock_status" class="form-select @error('stock_status') is-invalid @enderror">
                                                <option disabled>-- Stock Status --</option>
                                                <option value="IN_STOCK">Tersedia</option>
                                                <option value="OUT_OF_STOCK">Kosong</option>
                                            </select>
                                            @error('stock_status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>