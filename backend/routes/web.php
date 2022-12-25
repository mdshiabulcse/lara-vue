<?php

use App\Http\Controllers\ShopController;
use App\Models\ShopModel;
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

Route::get('/', function () {
    $datas= ShopModel::where('status', 1)->get();
    return view('welcome', compact('datas'));
});
Route::get('shop-location/{id}', function ($id) {
    $datas= ShopModel::find($id);
    return view('location', compact('datas'));
})->name('shop-location');
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/shop', ShopController::class);

