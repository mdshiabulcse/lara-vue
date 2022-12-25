<?php

use App\Http\Controllers\Api\User\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/test-test',function(){
//     return 'from User';
// });

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'Login');  
    Route::post('/register', 'Register');
});


Route::middleware('auth:user-api')->group( function () {
    Route::controller(AuthController::class)->group(function(){
        Route::post('/logout', 'Logout');
        Route::get('/me', 'User');
});
});