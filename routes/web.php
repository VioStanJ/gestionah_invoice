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

Route::get('category',[App\Http\Controllers\CategoryController::class,'index'])->name('category');
Route::get('category/save',[App\Http\Controllers\CategoryController::class,'create'])->name('category.create');

Route::get('/unit',[App\Http\Controllers\UnitController::class,'index'])->name('unit');
Route::get('/unit/create',[App\Http\Controllers\UnitController::class,'create'])->name('unit.create');
Route::post('/unit/store',[App\Http\Controllers\UnitController::class,'store'])->name('unit.store');
Route::get('/unit/edit/{id}',[App\Http\Controllers\UnitController::class,'edit'])->name('unit.edit');
Route::put('/unit/update',[App\Http\Controllers\UnitController::class,'update'])->name('unit.update');
