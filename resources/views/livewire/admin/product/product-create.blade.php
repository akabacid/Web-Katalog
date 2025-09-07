<div wire:ignore.self class="modal modal-blur fade" id="modal-product-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah produk</h5>
                <button wire:click="close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="mb-3">
                    <label class="form-label">SKU</label>
                    <input wire:model="sku" type="text" class="form-control @error('sku') is-invalid @enderror" name="example-text-input" disabled>
                    <small class="form-text text-muted">SKU akan dibuat secara otomatis dan tidak perlu diisi.</small>
                    @error('sku')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required">Nama</label>
                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="example-text-input" placeholder="">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
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
            </div>
            <div class="modal-footer">
                <a wire:click="close" href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Batal
                </a>
                <button wire:click="save" type="button" class="btn btn-primary ms-auto">Save</button>
            </div>
        </div>
    </div>
</div>