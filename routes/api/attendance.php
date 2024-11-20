<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Attendances'], function () {
    Route::post('/attendances', 'AddAttendanceController')->name('add-attendance');
    Route::put('/attendances/{attendance}', 'UpdateAttendanceController')->name('update-attendance');
    Route::get('/attendances/{attendance}', 'ShowAttendanceController')->name('show-attendance');
    Route::get('/classrooms/{classroom}/attendances', 'GetAttendanceStudentsController')->name('get-attendance-students');
    Route::get('semesters/{semester}/students/{student}/attendances', 'AttendanceDaysCountBySemesterController')->name('count-semester-attendance');
    Route::get('study-years/{year}/students/{student}/attendances', 'AttendanceDaysCountByYearController')->name('count-year-attendance');
});
