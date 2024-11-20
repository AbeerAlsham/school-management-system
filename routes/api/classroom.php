<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Classrooms'], function () {
    Route::post('classrooms/{classroom}', 'updateclassroomcontroller')->name('update-classroom');
    Route::delete('classrooms/{classroom}', 'DeleteClassroomController')->name('delete-classroom');
    Route::post('study-years/{studyYear}/classrooms/', 'createClassroomController')->name('create-classroom');
    Route::get('study-years/{studyYear}/study-Class/{class}/classrooms', 'GetClassroomByClassController')->name('get-year-class-classrooms');
});
