<?php

use App\Http\Controllers\Api\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::controller(AdminAuthController::class)->group(function(){
    Route::post('/login', 'Login');  
    Route::post('/register', 'Register');
});

Route::middleware('auth:admin-api')->group( function () {
    Route::controller(AdminAuthController::class)->group(function(){
        Route::post('/logout', 'Logout');
        Route::get('/me', 'User');
});
});