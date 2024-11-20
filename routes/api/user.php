<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkPermession'])->group(function () {
    Route::group(['namespace' => 'Users'], function () {
        Route::prefix('/users')->group(function () {
            Route::get('/index', 'GetUserController')->name('user.index');
            Route::post('/create', 'CreateUserController')->name('users.create')->middleware('transaction');
            Route::post('/{user}', 'UpdateUserController')->name('users.update')->middleware('checkOwner');
            Route::post('/profiles/{profile}', 'UpdateProfileController')->name('profiles.update');
            Route::get('/{user}', 'ShowUserController')->name('users.show');
            Route::Delete('/{user}', 'DeleteUserController')->name('users.delete');
            Route::post('/{user}/change_my_password', 'changeMyPasswordController')->name('users.changeMyPassword')->middleware('checkOwner');
            Route::post('/{user}/change_password', 'changePasswordController')->name('users.changePassword');
            Route::post('/{user}/roles', 'AddRoleController')->name('users.roles.add');
            Route::delete('/{user}/roles/{role}', 'removeRoleController')->name('users.roles.remove');
        });
    });
});
