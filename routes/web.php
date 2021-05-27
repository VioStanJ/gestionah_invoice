<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[App\Http\Controllers\Auth\LoginController::class,'showLoginForm']);
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
Route::get('/register',[App\Http\Controllers\Auth\RegisterController::class,'show'])->name('register');
Route::post('/register',[App\Http\Controllers\Auth\RegisterController::class,'create']);

Route::get('/verify/email',[App\Http\Controllers\VerifyAuthController::class,'verify']);
Route::post('/verify/email',[App\Http\Controllers\VerifyAuthController::class,'resend'])->name('verification.resend');
Route::get('/verify/your/email/{code}',[App\Http\Controllers\VerifyAuthController::class,'verifyCode']);

Route::middleware(['auth'])->group(function () {

    // Category
    Route::prefix('category')->group(function()
    {
        Route::get('/',[App\Http\Controllers\CategoryController::class,'index'])->name('category');
        Route::get('/save',[App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
        Route::post('/store',[App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
        Route::get('/edit/{id}',[App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
        Route::put('/update/{id}',[App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
        Route::delete('/delete/{id}',[App\Http\Controllers\CategoryController::class,'destroy'])->name('category.destroy');
    });

    // Unit
    Route::prefix('unit')->group(function()
    {
        Route::get('/',[App\Http\Controllers\UnitController::class,'index'])->name('unit');
        Route::get('/create',[App\Http\Controllers\UnitController::class,'create'])->name('unit.create');
        Route::post('/store',[App\Http\Controllers\UnitController::class,'store'])->name('unit.store');
        Route::get('/edit/{id}',[App\Http\Controllers\UnitController::class,'edit'])->name('unit.edit');
        Route::put('/update/{id}',[App\Http\Controllers\UnitController::class,'update'])->name('unit.update');
        Route::delete('/delete/{id}',[App\Http\Controllers\UnitController::class,'destroy'])->name('unit.destroy');
    });

    // Unit
    Route::prefix('product-service')->group(function()
    {
        Route::get('/',[App\Http\Controllers\ProductController::class,'index'])->name('productservice');
        Route::get('/create',[App\Http\Controllers\ProductController::class,'create'])->name('productservice.create');
        Route::post('/store',[App\Http\Controllers\ProductController::class,'store'])->name('productservice.store');
        Route::get('/edit/{id}',[App\Http\Controllers\ProductController::class,'edit'])->name('productservice.edit');
        Route::put('/update/{id}',[App\Http\Controllers\ProductController::class,'update'])->name('productservice.update');
        Route::delete('/delete/{id}',[App\Http\Controllers\ProductController::class,'destroy'])->name('productservice.destroy');
    });

    // Customers
    Route::prefix('customer')->group(function()
    {
        Route::get('/',[App\Http\Controllers\CustomerController::class,'index'])->name('customer');
        Route::get('/create',[App\Http\Controllers\CustomerController::class,'create'])->name('customer.create');
        Route::post('/store',[App\Http\Controllers\CustomerController::class,'store'])->name('customer.store');
        Route::get('/edit/{id}',[App\Http\Controllers\CustomerController::class,'edit'])->name('customer.edit');
        Route::put('/update/{id}',[App\Http\Controllers\CustomerController::class,'update'])->name('customer.update');
        Route::delete('/delete/{id}',[App\Http\Controllers\CustomerController::class,'destroy'])->name('customer.destroy');
        Route::get('/show/{code}',[App\Http\Controllers\CustomerController::class,'show'])->name('customer.show');
    });
});




