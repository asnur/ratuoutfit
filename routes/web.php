<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/cart', function () {
    return view('upage.cart');
});
Route::get('/checkout', function () {
    return view('upage.checkout');
});
Route::get('/myprofile', function () {
    return view('upage.myprofile');
});
Route::get('/produk', function () {
    return view('upage.produk');
});
Route::get('/blog', function () {
    return view('upage.blog');
});
Route::get('/blog-detail', function () {
    return view('upage.blog-detail');
});
Route::get('/katalog', function () {
    return view('upage.katalog');
});
Route::get('/riwayat', function () {
    return view('upage.riwayat');
});
Route::get('/dashboard', function () {
    return view('upage.admin.dashboard');
});

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail/{slug}', [HomeController::class, 'detail'])->name('detail');

Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
