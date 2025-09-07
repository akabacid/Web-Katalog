<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
		'user_id',
		'sku',
		'name',
		'slug',
		'price',
        'featured_image',
		'status',
		'stock_status',
		'publish_date',
		'excerpt',
		'body',
		'metas',
        'category_id'
    ];

    protected $table = 'shop_products';

    public const DRAFT = 'DRAFT';
	public const ACTIVE = 'ACTIVE';
	public const INACTIVE = 'INACTIVE';

    public const STATUSES = [
		self::DRAFT => 'Draft',
		self::ACTIVE => 'Active',
		self::INACTIVE => 'Inactive',
	];

    public const STATUS_IN_STOCK = 'IN_STOCK';
    public const STATUS_OUT_OF_STOCK = 'OUT_OF_STOCK';

    public const STOCK_STATUSES = [
        self::STATUS_IN_STOCK => 'Tersedia',
        self::STATUS_OUT_OF_STOCK => 'Kosong',
    ];

	public const SIMPLE = 'SIMPLE';
	public const CONFIGURABLE = 'CONFIGURABLE';
	public const TYPES = [
		self::SIMPLE => 'Simple',
		self::CONFIGURABLE => 'Configurable',
	];
    
    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function variants()
	{
		return $this->hasMany('Modules\Shop\Models\Product', 'parent_id')->orderBy('price', 'ASC');
	}

    public function tags()
    {
        return $this->belongsToMany('Modules\Shop\Models\Tag', 'shop_products_tags', 'product_id', 'tag_id');
    }

    public function attributes()
	{
		return $this->hasMany(ProductAttribute::class, 'product_id');
	}

    public function images()
	{
		return $this->hasMany(ProductImage::class, 'product_id');
	}
    public function image()
    {
        return $this->hasOne(ProductImage::class)->where('id', $this->featured_image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getStockstatusLabelAttribute()
    {
        return $this->stock_status === 'IN_STOCK' ? 'Tersedia' : 'Kosong';
    }

    public function getPriceLabelAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }

}
