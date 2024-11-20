<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Exams'], function () {
    Route::get('/exams/show-subject-exams', 'ShowSubjectExamController')->name('show-subject-exams');
    Route::get('/exams/show-teacher-exams', 'ShowTeacherExamController')->name('show-teacher-exams');
    Route::post('/exams', 'CreateExamController')->name('create-exam');
    Route::put('/exams/{exam}', 'UpdateExamController')->name('update-exam');
    Route::delete('/exams/{exam}', 'DeleteExamController')->name('delete-exam');
    Route::get('/exams/{exam}', 'ShowExamController')->name('show-exam');
});
