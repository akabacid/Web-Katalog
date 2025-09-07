<?php

namespace Modules\Shop\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\Category;
use Modules\Shop\Models\Tag;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductAttribute;
use Modules\Shop\Models\ProductInventory;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();


        Category::factory()->count(10)->create();
        $this->command->info('Categories created.');
        $randomCategoryIDs = Category::all()->random()->limit(2)->pluck('id');

        Tag::factory()->count(10)->create();
        $this->command->info('Tags created.');
        $randomTagIDs = Tag::all()->random()->limit(2)->pluck('id');

        for ($i = 1; $i <= 10; $i++) {
            $manageStock = (bool)random_int(0, 1);

            $product = Product::factory()->create([
                'user_id' => $user->id,
                'manage_stock' => $manageStock,
            ]);

            $product->categories()->sync($randomCategoryIDs);
            $product->tags()->sync($randomTagIDs);

        }

        $this->command->info('10 sample products seeded.');
    }
}
