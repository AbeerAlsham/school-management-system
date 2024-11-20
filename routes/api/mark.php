<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Marks'], function () {

    Route::post('exams/{exam}/marks', 'addMarkController')->name('add-mark');
    Route::put('marks/{mark}', 'updateMarkController')->name('update-mark');
    Route::delete('marks/{mark}', 'deleteMarkController')->name('delete-mark');
    Route::get('exams/{exam}/marks/show-classroom-marks', 'GetClassroomExamMarksController')
        ->name('show-classroom-marks');

    // Route::get('/marks/show-subject-mark-detail', 'ShowSubjectMarkDetailsController')
    //     ->name('show-student-mark');
    Route::put('marks/update-status-mark', 'UpdateStatusMarkController')->name('accept-mark');
    // Route::get('/classrooms/{classroom}/marks/get-studentss-marks', 'GetStudentsMarkDetailsController')
    //     ->name('get-students-marks');

    Route::get('study-years/{studyYear}/student-classes/{studentClass}/marks/show-academic-report', 'ShowReportCardController')
        ->name('show-academic-report-card');
    Route::get('semesters/{semester}/student-classes/{studentClass}/marks/show-semester-report', 'ShowSemesterReportCardController')
        ->name('show-semester-report-card');
});
