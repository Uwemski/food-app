<?php
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    return view();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function() {
    return view('login');
});

Route::get('/register', function() {
    return view('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/message',[TestController::class, 'index'])->middleware('is_admin');

// Route::get('role',[
//    'middleware' => 'Role:editor',
//    'uses' => 'TestController@index',
// ]);

Route::middleware('is_admin')->group(function() {
    Route::get('/test-admin', function() {
        return 'You have access';
    });
});

Route::get('/admin/categories', [CategoryController::class, 'index'])->middleware('is_admin');
Route::get('/admin/categories/create', [CategoryController::class, 'create']);
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/categories/edit/{id}', [AdminController::class, 'editCategory']);
//put?
Route::put('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
// Route::post();

//Product Controller routes
Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/products/create', [ProductController::class, 'create']);
Route::get('/admin/products/{product}', [ProductController::class, 'edit']);
Route::put('/admin/products/update/{id}', [ProductController::class, 'update']);
Route::patch('/admin/products/{product}/availabilty', [ProductController::class, 'updateAvailabilty']);
Route::post('/admin/products/create', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(['role:admin']);

Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/index', [CartController::class, 'viewCart'])->name('cart.index');
Route::delete('/cart/delete/{id}', [CartController::class, 'removeItem'])->name('cart.removeItem');

Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

//checkout controller routes [middleware required]
Route::get('/cart/checkout/index', [CheckoutController::class, 'index'])->name('checkout.index');

Route::post('/cart/checkout/process', [CheckoutController::class, 'processCheckout'])->name('cart.checkout.process');

Route::get('/shop/products', [ProductController::class, 'guestIndex'])->name('shop.index');

require __DIR__.'/auth.php';
