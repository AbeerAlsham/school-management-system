<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkPermession'])->group(function () {
    Route::group(['namespace' => 'StudyYears'], function () {
        Route::prefix('/study-years')->group(function () {
            Route::get('/index', 'IndexYearController')->name('years.index');
            Route::post('/create', 'CreateStudyYearController')->name('years.create');
            Route::post('/{studyYear}', 'UpdateStudyYearController')->name('years.update');
            Route::get('/{studyYear}', 'ShowStudyYearController')->name('years.show');
            Route::delete('/{studyYear}',  'DeleteStudyYearController')->name('years.delete');
        });
        // Route::get('supervisors/{user}/study-years', 'GetSupervisorYearsController')->name('index-supervisor-years'); //new
        Route::get('users-roles/{userRole}/get-teacher-study-years', 'GetTeacherYearsController')->name('years.indexTeacher'); //new
    });
});
