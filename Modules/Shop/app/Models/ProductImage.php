<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\Factories\ProductImageFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductImage extends Model implements HasMedia
{
    use HasFactory, HasUuids, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'shop_product_images';
    protected $fillable = [
        'product_id',
        'name'
    ];

    public const DEFAULT_IMAGE = 'https://placehold.jp/150x150.png';
    
    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\ProductImageFactory::new();
    }

    public function registerMediaConversions(Media $media = null): void
    {
       
    }

    public function deleteImage(): void
    {
        $this->clearMediaCollection('products'); // Deletes all media in the 'products' collection
    }
}
