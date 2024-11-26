<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkPermession'])->group(
    function () {
        Route::group(['namespace' => 'Classes'], function () {
            Route::prefix('/classes')->group(function () {
                Route::get('/', 'IndexClassesController')->name('classes.index');
                Route::post('/', 'createClassController')->name('classes.create');
                Route::Delete('/{class}', 'DeleteClassController')->name('classes.delete');
                Route::post('/{class}', 'updateClasscontroller')->name('classes.update');
            });
            Route::get('students/{student}/classes/get-students-results', 'GetStudentStudyResult')->name('classes.student.getResult');
            Route::prefix('/semesters-users/{semesterUser}/')->group(function () {
                Route::get('/index-supervisor-class', 'GetSupervisorClassesController')->name('classes.supervisor.index'); //new
                Route::get('classes/index-teacher-class', 'GetTeacherClassesController')->name('classes.teacher.index'); //new
            });
            Route::get('semesters/{semester}/supervisor/classes', 'GetUnRegisteredSupervisorsClassesController')->name('classes.getUnassignSupervisor'); //new
            Route::get('semesters/{semester}/teacher/classes', 'GetUnRegisteredTeachersClassesController')->name('classes.getUnassignTeacher'); //new
        });
    }
);
