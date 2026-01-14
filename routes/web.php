<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController; 
use App\Http\Controllers\AdminOrderController; 
use App\Http\Controllers\AdminUserController; 
use App\Http\Controllers\AdminMessageController; 



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===========================
// GUEST ROUTES (Login/Register)
// ===========================

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


// ===========================
// PROTECTED ROUTES (Must be Logged In)
// ===========================

Route::middleware(['auth'])->group(function () {

    // --- Main Pages ---
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
    Route::get('/admin/page', function () { return view('admin_page'); })->name('admin.page');

    // --- Contact Page ---
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [HomeController::class, 'sendMessage'])->name('send.message');

    // --- Product Details ---
    Route::get('/view_page/{id}', [HomeController::class, 'viewPage'])->name('view_page');

    // --- Cart System ---
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.cart');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart/delete/{id}', [CartController::class, 'removeFromCart'])->name('cart.delete');
    Route::get('/cart/delete-all', [CartController::class, 'clearCart'])->name('cart.delete.all');

    // --- Wishlist System ---
    Route::get('/wishlist', [CartController::class, 'wishlist'])->name('wishlist');
    Route::post('/add-to-wishlist', [CartController::class, 'addToWishlist'])->name('add.wishlist');
    Route::get('/wishlist/delete/{id}', [CartController::class, 'removeFromWishlist'])->name('wishlist.delete');
    Route::get('/wishlist/delete-all', [CartController::class, 'clearWishlist'])->name('wishlist.delete.all');

    // --- Checkout (Placeholder) ---
    Route::get('/checkout', function() { 
        return "Checkout Page coming soon"; 
    })->name('checkout');

Route::middleware(['auth'])->group(function () {
    // ... other routes ...
    
    // Checkout Routes
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('place.order');
});

});

Route::middleware(['auth'])->group(function () {
    // ... other routes ...
    
    // Orders Page
    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
});

Route::middleware(['auth'])->group(function () {
    // ... existing routes ...
    
    // Search Route
    Route::get('/search', [HomeController::class, 'search'])->name('search');
});

Route::middleware(['auth'])->group(function () {
    
    // ... other routes ...

    // Admin Dashboard
    Route::get('/admin/page', [AdminController::class, 'index'])->name('admin.page');

});

Route::middleware(['auth'])->group(function () {
    
    // ... your existing routes ...

    // --- ADMIN PANEL ROUTES ---
    Route::get('/admin/page', [AdminController::class, 'index'])->name('admin.page');

    // Placeholders for the links in the header (We will build these next)
    Route::get('/admin/products', function() { return "Products Page"; })->name('admin.products');
    Route::get('/admin/orders', function() { return "Orders Page"; })->name('admin.orders');
    Route::get('/admin/users', function() { return "Users Page"; })->name('admin.users');
    Route::get('/admin/messages', function() { return "Messages Page"; })->name('admin.messages');

});

Route::middleware(['auth'])->group(function () {
    
    // ... existing routes ...

    // --- Admin Products Routes ---
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::post('/admin/products/add', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/delete/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.delete');

});

Route::middleware(['auth'])->group(function () {
    
    // ... existing routes ...

    // --- Admin Product Update Routes ---
    Route::get('/admin/products/update/{id}', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/admin/products/update/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');

});

Route::middleware(['auth'])->group(function () {
    
    // ... existing routes ...

    // --- Admin Order Routes ---
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::post('/admin/orders/update', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update');
    Route::get('/admin/orders/delete/{id}', [AdminOrderController::class, 'destroy'])->name('admin.orders.delete');

});

Route::middleware(['auth'])->group(function () {
    
    // ... existing routes ...

    // --- Admin User Routes ---
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.delete');

});


Route::middleware(['auth'])->group(function () {
    
    // ... existing routes ...

    // --- Admin Message Routes ---
    Route::get('/admin/messages', [AdminMessageController::class, 'index'])->name('admin.messages');
    Route::get('/admin/messages/delete/{id}', [AdminMessageController::class, 'destroy'])->name('admin.messages.delete');

});