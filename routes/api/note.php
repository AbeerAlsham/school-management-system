<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Notes'], function () {
    Route::get('students-classes/{studentClass}/notes', 'GetAllNoteController')->name('index-note');
    Route::get('students-classes/{studentClass}/semesters-users/{semesterUser}/notes', 'GetTeacherNotesController')->name('index-teacher-note');
    Route::post('/notes', 'AddNoteController')->name('add-note');
    Route::post('notes/{note}', 'UpdateNoteController')->name('update-note');
    Route::delete('notes/{note}', 'DeleteNoteController')->name('delete-note');
});
