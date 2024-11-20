<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Students'], function () {
    Route::prefix('/students')->group(
        function () {
            Route::post('/', 'AddStudentController')->name('add-student')->middleware('transaction');
            Route::get('/', 'IndexStudentController')->name('index-student');
            Route::get('/{student}', 'ShowStudentController')->name('show-student');

            Route::post('/assign-class-students', 'AssignClassStudentsController')->name('assign-class-students');
            Route::post('/assign-classroom-students', 'AssignClassroomStudentsController')->name('assign-classroom-students');
        }
    );
    Route::get('/classrooms/{classroom}/index-classroom-students', 'GetClassroomStudentsController')->name('get-classroom-students');

    Route::prefix('/study-years/{studyYear}')->group(
        function () {
            Route::get('/study-classes/{studyClass}/index-class-students', 'GetClassStudentsController')->name('get-class-students');
            //Route::get('/study-classes/{studyClass}/unassigned-students', 'UnassignedStudentsInClassController')->name('get-unassign-class-students');
            Route::get('/study-classes/{studyClass}/unassigned-students', 'UnassignedStudentsInClassroomController')->name('get-unassign-classroom-students');
        }
    );
    Route::get('guardians/{user}/students', 'GetGuardinStudentsController')->name('get-guardian-students');
});
