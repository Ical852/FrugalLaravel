<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserpageController;
use App\Http\Controllers\VendorpageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/account_regist', [RegisterController::class, 'store']);
Route::get('/verification', [RegisterController::class, 'verification']);

Route::get('/forgot', [ForgotPasswordController::class, 'index'])->middleware('guest');
Route::post('/send', [ForgotPasswordController::class, 'send']);
Route::get('/reset', [ForgotPasswordController::class, 'reset'])->middleware('guest');
Route::post('/change', [ForgotPasswordController::class, 'change']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/shop/category/{slug}', [HomeController::class, 'category']);
Route::get('/shop/market/{vendor}', [HomeController::class, 'market']);
Route::get('/shop/detail/{id}', [HomeController::class, 'detail']);

Route::get('/toko/{toko}', [HomeController::class, 'toko']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/blog', [HomeController::class, 'blog']);

Route::get('/user', [UserpageController::class, 'index']);
Route::post('/user/updatep', [UserpageController::class, 'updateprofile']);
Route::get('/user/changepw', [UserpageController::class, 'changepw']);
Route::post('/user/resetpw', [UserpageController::class, 'resetpw']);
Route::get('/user/update', [UserpageController::class, 'update']);
Route::post('/user/updateimg', [UserpageController::class, 'updateimg']);
Route::get('/user/cart', [UserpageController::class, 'cart']);
Route::post('/user/add/{id}', [UserpageController::class, 'add']);
Route::patch('/user/updatecart', [UserpageController::class, 'updatecart']);
Route::delete('/user/cartdelete/{id}', [UserpageController::class, 'deletecart']);
Route::post('/user/address', [UserpageController::class, 'address']);
Route::post('/user/checkout', [UserpageController::class, 'checkout']);
Route::get('/user/payment', [UserpageController::class, 'payment']);
Route::delete('/user/deletecheckout/{id}', [UserpageController::class, 'deletecheckout']);
Route::get('/user/onprocess', [UserpageController::class, 'process']);
Route::get('/user/ontheway', [UserpageController::class, 'ontheway']);
Route::get('/user/done', [UserpageController::class, 'done']);
Route::post('/user/accept/{id}', [UserpageController::class, 'accept']);
Route::post('/user/rating/{getter}', [UserpageController::class, 'rating']);
Route::post('/user/wish/{id}', [UserpageController::class, 'wish']);
Route::post('/user/wishdel/{id}', [UserpageController::class, 'wishdel']);
Route::get('/user/whistlist', [UserpageController::class, 'wishlist']);

Route::get('/administrator', [AdminDashboardController::class, 'index']);
Route::delete('/admin/destroy/{email}', [AdminDashboardController::class, 'destroy']);
Route::post('/admin/verify/{id}', [AdminDashboardController::class, 'verify']);
Route::post('/admin/ban/{id}', [AdminDashboardController::class, 'ban']);
Route::post('/admin/unban/{id}', [AdminDashboardController::class, 'unban']);
Route::resource('/admin/dashboard', AdminDashboardController::class);
Route::get('/admin/edit/{id}', [AdminDashboardController::class, 'edit']);
Route::post('/admin/update/{id}', [AdminDashboardController::class, 'update']);
Route::get('/admin/category', [AdminDashboardController::class, 'category']);
Route::get('/admin/createcategory', [AdminDashboardController::class, 'createcategory']);
Route::post('/admin/addcategory', [AdminDashboardController::class, 'addcategory']);
Route::get('/admin/editcategory/{id}', [AdminDashboardController::class, 'editcategory']);
Route::post('/admin/updatecategory/{id}', [AdminDashboardController::class, 'updatecategory']);
Route::delete('/admin/delcategory/{id}', [AdminDashboardController::class, 'deletecategory']);
Route::get('/admin/profile', [AdminDashboardController::class, 'profile']);
Route::post('/admin/profileup', [AdminDashboardController::class, 'profileup']);
Route::get('/admin/changeimg/', [AdminDashboardController::class, 'changeimg']);
Route::post('/admin/updateimg/', [AdminDashboardController::class, 'updateimg']);
Route::get('/admin/changepw', [AdminDashboardController::class, 'changepw']);
Route::post('/admin/updatepw', [AdminDashboardController::class, 'updatepw']);
Route::get('/admin/vendordata', [AdminDashboardController::class, 'vendordata']);
Route::get('/admin/transaction', [AdminDashboardController::class, 'transaction']);

Route::get('/vendorpage', [VendorpageController::class, 'index']);
Route::get('/yourmarket', [VendorpageController::class, 'yourmarket']);
Route::get('/vendor/openmarket', [VendorpageController::class, 'openmarket']);
Route::post('/vendor/addmarket', [VendorpageController::class, 'addmarket']);
Route::get('/vendor/editmarket', [VendorpageController::class, 'editmarket']);
Route::post('/vendor/updatemarket', [VendorpageController::class, 'updatemarket']);
Route::delete('/vendor/closemarket', [VendorpageController::class, 'closemarket']);
Route::get('/vendor/createproduct', [VendorpageController::class, 'createproduct']);
Route::post('/vendor/addproduct', [VendorpageController::class, 'addproduct']);
Route::get('/vendor/editproduct/{id}', [VendorpageController::class, 'editproduct']);
Route::post('/vendor/updatedproduct/{id}', [VendorpageController::class, 'updateproduct']);
Route::get('/vendor/uploadimg/{id}', [VendorpageController::class, 'uploadimg']);
Route::get('/vendor/uploadimg2/{id}', [VendorpageController::class, 'uploadimg2']);
Route::get('/vendor/uploadimg3/{id}', [VendorpageController::class, 'uploadimg3']);
Route::get('/vendor/uploadimg4/{id}', [VendorpageController::class, 'uploadimg4']);
Route::post('/vendor/updateimg/{id}', [VendorpageController::class, 'updateimg']);
Route::post('/vendor/updateimg2/{id}', [VendorpageController::class, 'updateimg2']);
Route::post('/vendor/updateimg3/{id}', [VendorpageController::class, 'updateimg3']);
Route::post('/vendor/updateimg4/{id}', [VendorpageController::class, 'updateimg4']);
Route::delete('/vendor/deleteproduct/{id}', [VendorpageController::class, 'deleteproduct']);
Route::post('/vendor/confirm/{id}', [VendorpageController::class, 'confirm']);
Route::delete('/vendor/cancel/{id}', [VendorpageController::class, 'cancel']);
Route::post('/vendor/send/{id}', [VendorpageController::class, 'send']);
Route::get('/vendor/vendorimg', [VendorpageController::class, 'vendorimg']);
Route::post('/vendor/upvendorimg', [VendorpageController::class, 'upvendorimg']);
Route::get('/vendor/profile', [VendorpageController::class, 'profile']);
Route::post('/vendor/profileup', [VendorpageController::class, 'profileup']);
Route::get('/vendor/changeimg/', [VendorpageController::class, 'changeimg']);
Route::post('/vendor/updatepimg/', [VendorpageController::class, 'updatepimg']);
Route::get('/vendor/changepw', [VendorpageController::class, 'changepw']);
Route::post('/vendor/updatepw', [VendorpageController::class, 'updatepw']);
