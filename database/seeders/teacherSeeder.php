<?php

namespace Database\Seeders;

use App\Models\Accounts\User;
use App\Models\AssignmentTeacher;
use App\Models\Exam;
use App\Models\SemesterUser;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class teacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'username' => "abeer",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(2);

        $userRole = UserRole::create([
            'role_id' => 2,
            'user_id' => $user->id,
        ]);

        // إدخال بيانات semester_users
        $semesterUser1 = SemesterUser::create([
            'user_role_id' => $userRole->id,
            'semester_id' => 4,
        ]);
        // إدخال بيانات semester_users
        $semesterUser2 = SemesterUser::create([
            'user_role_id' => $userRole->id,
            'semester_id' => 3,
        ]);

        AssignmentTeacher::create([
            'semester_user_id' => $semesterUser1->id,
            'subject_id' => 5,
            // 'section_id' => 1,
            'class_id' => 1,
            'classroom_id' => 1,
        ]);
        AssignmentTeacher::create([
            'semester_user_id' => $semesterUser1->id,
            'subject_id' => 13,
            'section_id' => 3,
            'class_id' => 1,
            'classroom_id' => 1,
        ]);
        AssignmentTeacher::create([
            'semester_user_id' => $semesterUser2->id,
            'subject_id' => 13,
            'section_id' => 3,
            'class_id' => 1,
            'classroom_id' => 2,
        ]);
        AssignmentTeacher::create([
            'semester_user_id' => $semesterUser2->id,
            'subject_id' => 13,
            'section_id' => 4,
            'class_id' => 1,
            'classroom_id' => 2,
        ]);

        Exam::create([
            'semester_id' => 3,
            'subject_id' => 13,
            'section_id' => 3,
            'exam_type_id' => 2,
            'semester_user_id' => $semesterUser2->id,
            'classroom_id' => 1,
            'test_name' => 'مذاكرة أولى',
            'total_mark' => 100,
        ]);

        Exam::create([
            'semester_id' => 3,
            'subject_id' => 13,
            'section_id' => 3,
            'exam_type_id' => 4,
            'semester_user_id' => $semesterUser2->id,
            'classroom_id' => 1,
            'test_name' => 'مذاكرة أولى',
            'total_mark' => 100,
        ]);

        Exam::create([
            'semester_id' =>4,
            'subject_id' => 5,
            'section_id' => 4,
            'exam_type_id' => 3,
            'semester_user_id' => $semesterUser1->id,
            'classroom_id' => 1,
            'test_name' => 'مذاكرة أولى',
            'total_mark' => 100]);
    }
}
