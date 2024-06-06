<?php

// Admin Controller
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
// User Controller
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CartController as UserCartController;
use App\Http\Controllers\User\PaymentController as UserPaymentController;
use App\Http\Controllers\User\AboutController as UserAboutController;
// Auth Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\AdminAuthCheck;
use App\Http\Middleware\UserAuthCheck;
// Others
use Illuminate\Support\Facades\Route;

Route::get('/', [UserHomeController::class, 'index'])->name('user.home');
Route::get('/about', [UserAboutController::class, 'index'])->name('user.about');

// User -> Product Route
Route::get('/products', [UserProductController::class, 'index'])->name('user.product');
Route::get('/products/{product_id}', [UserProductController::class, 'show'])->name('user.productDetails');

// Auth Routes
Route::prefix('/auth')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.loginAction');
    // Register
    Route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('auth.registerAction');
    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logoutAction');
});

Route::middleware([UserAuthCheck::class])->group(function () {
    // Admin Routes
    Route::middleware([AdminAuthCheck::class])->group(function () {
        Route::prefix('/admin')->group(function() {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
            // Product
            Route::get('/product', [AdminProductController::class, 'index'])->name('admin.product');
            Route::post('/product', [AdminProductController::class, 'store'])->name('admin.storeProduct');
            Route::delete('/product/{product_id}', [AdminProductController::class, 'delete'])->name('admin.deleteProduct');
            // Category
            Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.category');
            Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.storeCategory');
            Route::delete('/categories/{category_id}', [AdminCategoryController::class, 'delete'])->name('admin.deleteCategory');
            // Purchase
            Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.order');
        });
    });

    // User Routes
    Route::get('/cart', [UserCartController::class, 'index'])->name('user.cart');
    Route::get('/payment', [UserPaymentController::class, 'index'])->name('user.payment');
});
