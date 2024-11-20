<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkPermession'])->group(function () {
    Route::group(['namespace' => 'Roles'], function () {
        Route::get('roles', 'IndexRoleController')->name('roles.index');
        Route::get('users/{user}/roles/not_assign', 'GetNotAssignRolesController')->name('roles.notAssign');
    });
});
