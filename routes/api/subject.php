<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Subjects'], function () {
    Route::get('/subjects', 'IndexSubjectsController')->name('subjects.index');
    Route::post('/subjects', 'createSubjectController')->name('subjects.create');
    Route::post('/subjects/{subject}', 'UpdateSubjectController')->name('subjects.update');
    Route::delete('/subjects/{subject}', 'DeleteSubjectController')->name('subjects.delete');

    Route::post('subjects/{subject}/add_section', 'AddSectionController')->name('subjects.section.add');
    Route::post('sections/{section}', 'UpdateSectionController')->name('subjects.sections.update');
    Route::delete('sections/{section}', 'RemoveSectionController')->name('subjects.sections.remove');

    Route::post('/users/{user}/subjects', 'AssignmentTeacherSubjectsController')->name('subjects.assignTeacher');
    Route::get('/users/{user}/subjects', 'GetTeacherSubjectsController')->name('subjects.getForTeacher');

    Route::post('/classes/{class}/subjects/{subject}', 'addSubjectToClassController')->name('subjects.class.add');
    Route::delete('/classes/{class}/subjects/{subject}', 'DeleteClassSubjectController')->name('subjects.class.delete');
    Route::get('/classes/{class}/subjects', 'GetClassSubjectController')->name('subjects.class.get');
    Route::get('/semesters-users/{semesterUser}/subjects', 'GetTeacherSubjectsSemesterController')->name('subjects.semester.teacher.index'); //new
    Route::get('semesters/{semester}/classes/{class}/classrooms/{classroom}/subjects', 'GetUnAssignmentSubjectController')->name('subjects.classroom.indexUnassign'); //new
});
