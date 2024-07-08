<?php

use App\Http\Controllers\Api\subjects\addSubjectToClassController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\StudyYears\CreateSemesterController;
use App\Http\Controllers\Api\StudyYears\CreateStudyYearController;
use App\Http\Controllers\Api\StudyYears\DeleteSemesterController, App\Http\Controllers\Api\Classes\DeleteClassController;
use App\Http\Controllers\Api\StudyYears\DeleteStudyYearController;
use App\Http\Controllers\Api\StudyYears\{ShowStudyYearController, ShowSemesterController, GetSemesterController};
use App\Http\Controllers\Api\StudyYears\{UpdateSemesterController, UpdateStudyYearController};
use App\Http\Controllers\Api\classes\createClassController;
use App\Http\Controllers\Api\Users\AddRoleController;
use App\Http\Controllers\Api\Users\changePasswordController;
use App\Http\Controllers\Api\Users\removeRoleController;
use App\Http\Controllers\Api\Users\CreateUserController;
use App\Http\Controllers\Api\Users\DeleteUserController;
use App\Http\Controllers\Api\Users\GetUserController;
use App\Http\Controllers\Api\Users\ShowUserController;
use App\Http\Controllers\Api\Users\UpdateUserController;
use App\Http\Controllers\Api\subjects\createSubjectController;
use App\Http\Controllers\Api\subjects\IndexSubjectsController;
use App\Http\Controllers\Api\classes\IndexClassesController;
use App\Http\Controllers\Api\classes\updateClasscontroller;
use App\Http\Controllers\Api\classrooms\DeleteClassroomController;
use App\Http\Controllers\Api\classrooms\GetClassroomByClassController;
use App\Http\Controllers\Api\subjects\DeleteSubjectController;
use App\Http\Controllers\Api\subjects\GetClassSubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudyYears\IndexYearController;
use App\Http\Controllers\Api\Users\UpdateProfileController;
use App\Http\Controllers\Api\classrooms\createClassroomController;
use App\Http\Controllers\Api\classrooms\updateclassroomcontroller;
use App\Http\Controllers\APi\Subjects\AssignmentTeacherSubjectsController;
use App\Http\Controllers\APi\subjects\GetTeacherSubjectsController;
use App\Http\Controllers\Api\Users\AssignSemesterUsersController;

Route::post('login', LoginController::class);

Route::middleware(['auth:sanctum', 'checkPermession'])->group(function () {
    Route::post('logout', LogoutController::class);

    Route::prefix('/studyYears')->group(function () {
        Route::get('/', IndexYearController::class)->name('index-academic-year');
        Route::post('/', CreateStudyYearController::class)->name('create-academic-year');
        Route::post('/{studyYear}', UpdateStudyYearController::class)->name('update-academic-year');
        Route::get('/{studyYear}', ShowStudyYearController::class)->name('show-academic-year');
        Route::delete('/{studyYear}',  DeleteStudyYearController::class)->name('delete-academic-year');
        Route::get('/{studyYear}/semesters', GetSemesterController::class)->name('index-year-semester');
        Route::post('/{studyYear}/semesters', CreateSemesterController::class)->name('create-year-semester');
        Route::post('/{studyYear}/classrooms/', createClassroomController::class)->name('create-classroom');
        Route::get('/{studyYear}/study-Class/{class}/classrooms', GetClassroomByClassController::class)->name('get-year-class-classrooms');
    });

    Route::prefix('/semesters')->group(function () {

        Route::post('/{semester}', UpdateSemesterController::class)->name('update-semester');
        Route::delete('/{semester}', DeleteSemesterController::class)->name('delete-semester');
        Route::get('/{semester}', ShowSemesterController::class)->name('show-semester');
        Route::post('/{semester}/assign-semester-teacher',AssignSemesterUsersController::class)->name('assign-semester-teacher');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', GetUserController::class)->name('index-user');
        Route::post('/', CreateUserController::class)->name('create-user')->middleware('transaction');
        Route::post('/{user}', UpdateUserController::class)->name('update-user')->middleware('checkOwner');
        Route::post('/profiles/{profile}', UpdateProfileController::class)->name('update-profile');
        Route::get('/{user}', ShowUserController::class)->name('show-user');
        Route::Delete('/{user}', DeleteUserController::class)->name('delete-user');
        Route::post('/{user}/changePassword', changePasswordController::class)->name('change-password');
        Route::post('/{user}/roles', AddRoleController::class)->name('add-role-user');
        Route::delete('/{user}/roles/{role}', removeRoleController::class)->name('remove-role-user');
    });
    Route::prefix('/subjects')->group(function () {
        Route::get('/', IndexSubjectsController::class)->name('index-subject');
        Route::post('/', createSubjectController::class)->name('create-subject');
        Route::delete('/{subject}', DeleteSubjectController::class)->name('delete-subject');
        Route::post('/users/{user}', AssignmentTeacherSubjectsController::class)->name('assign-teacher-subjects');
        Route::get('/users/{user}', GetTeacherSubjectsController::class)->name('get-teacher-subjects');
    });

    Route::prefix('/classes')->group(function () {
        Route::get('/', IndexClassesController::class)->name('index-class');
        Route::post('/', createClassController::class)->name('create-class');
        Route::Delete('/{class}', DeleteClassController::class)->name('delete-class');
        Route::post('/{class}', updateClasscontroller::class)->name('update-class');
        Route::post('/{class}/subjects/{subject}', addSubjectToClassController::class)->name('add-class-subject');
        Route::delete('/{class}/subjects/{subject}')->name('delete-class-subject');
        Route::get('/{class}/subjects', GetClassSubjectController::class)->name('get-class-subjects');
    });

    Route::prefix('/classrooms')->group(function () {
        Route::post('/{classroom}', updateclassroomcontroller::class)->name('update-classroom');
        Route::delete('/{classroom}', DeleteClassroomController::class)->name('delete-classroom');
    });
});
