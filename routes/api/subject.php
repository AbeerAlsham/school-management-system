<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Subjects'], function () {
    Route::get('/subjects', 'IndexSubjectsController')->name('index-subject');
    Route::post('/subjects', 'createSubjectController')->name('create-subject');
    Route::delete('/subjects/{subject}', 'DeleteSubjectController')->name('delete-subject');

    Route::post('/users/{user}/subjects', 'AssignmentTeacherSubjectsController')->name('assign-teacher-subjects');
    Route::get('/users/{user}/subjects', 'GetTeacherSubjectsController')->name('get-teacher-subjects');

    Route::post('/classes/{class}/subjects/{subject}', 'addSubjectToClassController')->name('add-class-subject');
    Route::delete('/classes/{class}/subjects/{subject}', 'DeleteClassSubjectController')->name('delete-class-subject');
    Route::get('/classes/{class}/subjects', 'GetClassSubjectController')->name('get-class-subjects');
    Route::get('/semesters-users/{semesterUser}/subjects', 'GetTeacherSubjectsSemesterController')->name('index-semester-teacher-subjects'); //new
    Route::get('semesters/{semester}/classes/{class}/classrooms/{classroom}/subjects', 'GetUnAssignmentSubjectController')->name('index-classroom-unassign_subjects'); //new
});
