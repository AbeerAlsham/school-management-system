<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'LogoutController');
    });
});
