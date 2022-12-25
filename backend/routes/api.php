<?php

use App\Http\Controllers\ShopController;
use App\Models\ShopModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('/shop', ShopController::class);
// Route::get('/', function () {
//     $datas= ShopModel::where('status', 1)->get();
//     return view('welcome', compact('datas'));
// });
// Route::get('shop-location/{id}', function ($id) {
//     $datas= ShopModel::find($id);
//     return view('location', compact('datas'));
// })->name('shop-location');
// Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('/shop', ShopController::class);

// this api route comment for local blade view . i know restapi laravel 