<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Product\ProductIndex;
use App\Livewire\Admin\Product\ProductUpdate;
use App\Livewire\Admin\Category\CategoryIndex;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use Modules\Shop\Http\Controllers\ProductImageController;
use Modules\Shop\Http\Controllers\ProductController; // Ensure this class exists in the specified namespace
use Modules\Shop\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('products.index'); // Redirect to the products page
});

Route::get('/home', function () {
     return redirect()->route('products.index'); // Redirect to the products page
 });
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function()
{
     Route::get('/dashboard', Dashboard::class)->name('dashboard.index');
     Route::get('/categories', CategoryIndex::class)->name('categories.index');
     Route::get('/products', ProductIndex::class)->name('products.index');
     Route::get('/products/{id}/edit', ProductUpdate::class)->name('products.update');
     Route::post('/update-whatsapp', function (Illuminate\Http\Request $request) {
        $request->validate([
            'whatsapp_number' => 'nullable|string|max:20'
        ]);
        $user = auth()->user();
        $user->whatsapp_number = $request->whatsapp_number;
        $user->save();
        return back()->with('success', 'WhatsApp number updated!');
    })->name('update.whatsapp')->middleware('auth');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::delete('/product-images/{id}', [ProductImageController::class, 'deleteImage'])->name('product-images.delete');

