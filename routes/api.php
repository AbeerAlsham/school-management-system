<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['namespace' => 'App\Http\Controllers\Api'],
    function () {
        Route::group(['namespace' => 'Auth'], function () {
            Route::post('login', 'LoginController');
            Route::middleware('auth:sanctum')->group(function () {
                Route::post('logout', 'LogoutController');
            });
        });
        Route::middleware('auth:sanctum')->group(
            function () {
                Route::group(['namespace' => 'Roles'], function () {});
                Route::group(
                    ['namespace' => 'Notifications'],
                    function () {
                        Route::get('/semesters/{semester}/users-roles/{userRole}/notifications', 'GetNotificationController');
                        Route::get('/notifications/{notification}', 'ShowNotificationController');
                        Route::put('notifications/{notification}/read-notification', 'ReadNotificationController');
                        Route::get('semesters/{semester}/users-roles/{userRole}/notifications/unread-count', 'UnReadCountsNotificationController');
                    }
                );
            }
        );
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

                Route::group(['namespace' => 'Classrooms'], function () {
                    Route::post('classrooms/{classroom}', 'updateclassroomcontroller')->name('update-classroom');
                    Route::delete('classrooms/{classroom}', 'DeleteClassroomController')->name('delete-classroom');
                    Route::post('study-years/{studyYear}/classrooms/', 'createClassroomController')->name('create-classroom');
                    Route::get('study-years/{studyYear}/study-Class/{class}/classrooms', 'GetClassroomByClassController')->name('get-year-class-classrooms');
                });

                Route::group(['namespace' => 'Semesters'], function () {
                    Route::get('study-years/{studyYear}/semesters', 'GetSemesterController')->name('index-year-semester');
                    Route::post('study-years/{studyYear}/semesters', 'CreateSemesterController')->name('create-year-semester');
                    Route::post('semesters/{semester}', 'UpdateSemesterController')->name('update-semester');
                    Route::delete('semesters/{semester}', 'DeleteSemesterController')->name('delete-semester');
                    Route::get('semesters/{semester}', 'ShowSemesterController')->name('show-semester');
                });

                Route::group(['namespace' => 'StudyYears'], function () {
                    Route::prefix('/study-years')->group(function () {
                        Route::get('/index', 'IndexYearController')->name('index-academic-year');
                        Route::post('/create', 'CreateStudyYearController')->name('create-academic-year');
                        Route::post('/{studyYear}', 'UpdateStudyYearController')->name('update-academic-year');
                        Route::get('/{studyYear}', 'ShowStudyYearController')->name('show-academic-year');
                        Route::delete('/{studyYear}',  'DeleteStudyYearController')->name('delete-academic-year');
                    });
                    // Route::get('supervisors/{user}/study-years', 'GetSupervisorYearsController')->name('index-supervisor-years'); //new
                    Route::get('users-roles/{userRole}/get-teacher-study-years', 'GetTeacherYearsController')->name('index-teacher-years'); //new
                });

                Route::group(['namespace' => 'Holidays'], function () {
                    Route::get('/study-years/{studyYear}/holidays', 'IndexHolidayController')->name('index-holiday');
                    Route::get('holidays/{holiday}', 'ShowHolidayController')->name('show-holiday');
                    Route::post('/study-years/{studyYear}/holidays', 'CreateHolidayController')->name('add-holiday');
                    Route::put('/holidays/{holiday}', 'UpdateHolidayController')->name('update-holiday');
                    Route::delete('holidays/{holiday}', 'DeleteHolidayController')->name('delete-holiday');
                });

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

                Route::group(['namespace' => 'Teachers'], function () {
                    Route::post('supervisors/assign', 'AssignmentSupervisorController')->name('assign-supervisor');
                    Route::post('teachers/assign', 'AssignmentTeacherController')->name('assign-teacher');
                    Route::post('semesters/{semester}/assign-semester-user', 'AssignSemesterUsersController')->name('assign-semester-teacher');
                    Route::get('semesters/{semester}/unregister-semester-user', 'GetUnregisteredUsersController')->name('unregister-semester-teacher');
                    Route::get('semesters/{semester}/register-semester-user', 'GetRegisteredUsersController')->name('register-semester-teacher');
                    Route::get('semesters/{semester}/subjects/{subject}/teachers', 'GetSubjectTeachersController')->name('get-subject-teachers');
                });

                Route::group(['namespace' => 'Users'], function () {
                    Route::prefix('/users')->group(function () {
                        Route::get('/index', 'GetUserController')->name('index-user');
                        Route::post('/create', 'CreateUserController')->name('create-user')->middleware('transaction');
                        Route::post('/{user}', 'UpdateUserController')->name('update-user')->middleware('checkOwner');
                        Route::post('/profiles/{profile}', 'UpdateProfileController')->name('update-profile');
                        Route::get('/{user}', 'ShowUserController')->name('show-user');
                        Route::Delete('/{user}', 'DeleteUserController')->name('delete-user');
                        Route::post('/{user}/changePassword', 'changePasswordController')->name('change-password');
                        Route::post('/{user}/roles', 'AddRoleController')->name('add-role-user');
                        Route::delete('/{user}/roles/{role}', 'removeRoleController')->name('remove-role-user');
                    });
                });

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

                Route::group(['namespace' => 'LeavingSchool'], function () {
                    Route::post('students/{student}/leaving-students', 'AddLeavingSchoolController')->name('add-leaving-student');
                    Route::post('leaving-students/{leavingStudent}', 'UpdateLeavingSchoolController')->name('update-leaving-student');
                    Route::get('students/{student}/leaving-students', 'ShowLeavingSchoolController')->name('show-leaving-student');
                });
                Route::group(['namespace' => 'Marks'], function () {

                    Route::post('exams/{exam}/marks', 'addMarkController')->name('add-mark');
                    Route::put('marks/{mark}', 'updateMarkController')->name('update-mark');
                    Route::delete('marks/{mark}', 'deleteMarkController')->name('delete-mark');
                    Route::get('exams/{exam}/marks/show-classroom-marks', 'GetClassroomExamMarksController')
                        ->name('show-classroom-marks');

                    Route::get('/marks/show-subject-mark-detail', 'ShowSubjectMarkDetailsController')
                        ->name('show-student-mark');
                    Route::put('marks/update-status-mark', 'UpdateStatusMarkController')->name('accept-mark');
                    // Route::get('/classrooms/{classroom}/marks/get-studentss-marks', 'GetStudentsMarkDetailsController')
                    //     ->name('get-students-marks');

                    Route::get('study-years/{studyYear}/student-classes/{studentClass}/marks/show-academic-report', 'ShowReportCardController')
                        ->name('show-academic-report-card');
                    Route::get('semesters/{semester}/student-classes/{studentClass}/marks/show-semester-report', 'ShowSemesterReportCardController')
                        ->name('show-semester-report-card');
                });
                Route::group(
                    ['namespace' => 'Guardians'],
                    function () {
                        Route::prefix('/guardians')->group(
                            function () {
                                Route::post('/', 'AddGuardianController')->name('add-guardian')->middleware('transaction');
                                Route::post('/{guardian}', 'EditGuardianController')->name('update-guardian');
                                Route::get('/', 'IndexGuardianController')->name('index-guardian');
                            }
                        );

                        Route::get('users/{user}/guardians', 'ShowGuardianController')->name('show-guardian')->middleware('checkOwner');
                    }
                );

                Route::group(['namespace' => 'Attendances'], function () {
                    Route::post('/attendances', 'AddAttendanceController')->name('add-attendance');
                    Route::put('/attendances/{attendance}', 'UpdateAttendanceController')->name('update-attendance');
                    Route::get('/attendances/{attendance}', 'ShowAttendanceController')->name('show-attendance');
                    Route::get('/classrooms/{classroom}/attendances', 'GetAttendanceStudentsController')->name('get-attendance-students');
                    Route::get('semesters/{semester}/students/{student}/attendances', 'AttendanceDaysCountBySemesterController')->name('count-semester-attendance');
                    Route::get('study-years/{year}/students/{student}/attendances', 'AttendanceDaysCountByYearController')->name('count-year-attendance');
                });

                Route::group(['namespace' => 'Exams'], function () {
                    Route::get('/exams/show-subject-exams', 'ShowSubjectExamController')->name('show-subject-exams');
                    Route::get('/exams/show-teacher-exams', 'ShowTeacherExamController')->name('show-teacher-exams');
                    Route::post('/exams', 'CreateExamController')->name('create-exam');
                    Route::put('/exams/{exam}', 'UpdateExamController')->name('update-exam');
                    Route::delete('/exams/{exam}', 'DeleteExamController')->name('delete-exam');
                    Route::get('/exams/{exam}', 'ShowExamController')->name('show-exam');
                });

                Route::group(['namespace' => 'Notes'], function () {
                    Route::get('students-classes/{studentClass}/notes', 'GetAllNoteController')->name('index-note');
                    Route::get('students-classes/{studentClass}/semesters-users/{semesterUser}/notes', 'GetTeacherNotesController')->name('index-teacher-note');
                    Route::post('/notes', 'AddNoteController')->name('add-note');
                    Route::post('notes/{note}', 'UpdateNoteController')->name('update-note');
                    Route::delete('notes/{note}', 'DeleteNoteController')->name('delete-note');
                });
            }
        );
    }
);
