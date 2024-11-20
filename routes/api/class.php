<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkPermession'])->group(
    function () {
        Route::group(['namespace' => 'Classes'], function () {
            Route::prefix('/classes')->group(function () {
                Route::get('/', 'IndexClassesController')->name('index-class');
                Route::post('/', 'createClassController')->name('create-class');
                Route::Delete('/{class}', 'DeleteClassController')->name('delete-class');
                Route::post('/{class}', 'updateClasscontroller')->name('update-class');
            });
            Route::get('students/{student}/classes/get-students-results', 'GetStudentStudyResult')->name('get-student-result');
            Route::prefix('/semesters-users/{semesterUser}/')->group(function () {
                Route::get('/index-supervisor-class', 'GetSupervisorClassesController')->name('get-supervisor-classes'); //new
                Route::get('classes/index-teacher-class', 'GetTeacherClassesController')->name('get-teacher-classes'); //new
            });
            Route::get('semesters/{semester}/supervisor/classes', 'GetUnRegisteredSupervisorsClassesController')->name('get-unassign-supervisor-classes'); //new
            Route::get('semesters/{semester}/teacher/classes', 'GetUnRegisteredTeachersClassesController')->name('get-unassign-teacher-classes'); //new
        });
    }
);
