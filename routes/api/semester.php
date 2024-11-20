<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkPermession'])->group(function () {
    Route::group(['namespace' => 'Semesters'], function () {
        Route::get('study-years/{studyYear}/semesters', 'GetSemesterController')->name('semesters.indexYear');
        Route::post('study-years/{studyYear}/semesters', 'CreateSemesterController')->name('semesters.create');
        Route::post('semesters/{semester}', 'UpdateSemesterController')->name('semesters.update');
        Route::delete('semesters/{semester}', 'DeleteSemesterController')->name('semesters.delete');
        Route::get('semesters/{semester}', 'ShowSemesterController')->name('semesters.show');
    });
});
