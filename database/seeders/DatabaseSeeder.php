<?php

namespace Database\Seeders;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Support\Facades\Hash;
use App\Models\Accounts\User;
use App\Models\Classes\StudyClass;
use App\Models\Subjects\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => "manager",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(1);

        $user = User::create([
            'username' => "teacherabeer",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(2);

        $user = User::create([
            'username' => "teacherasmaa",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(2);
        $user = User::create([
            'username' => "scretarynoura",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(4);

        //اضافة عام دراسي
        $StudyYear1 = StudyYear::create(['name' => '2022-2023', 'start_date' => '2023-10-09', 'end_date' => '2024-05-06']);
        $StudyYear1->semesters()->create(['name' => 'الفصل الأول', 'start_date' => '2023-10-09', 'end_date' => '2024-01-01']);
        $StudyYear1->semesters()->create(['name' => 'الفصل الثاني', 'start_date' => '2023-01-05', 'end_date' => '2024-05-06']);

        $StudyYear2 = StudyYear::create(['name' => '2023-2024', 'start_date' => '2023-01-09', 'end_date' => '2024-06-06']);
        $StudyYear1->semesters()->create(['name' => 'الفصل الأول', 'start_date' => '2023-01-09', 'end_date' => '2024-01-01']);
        $StudyYear1->semesters()->create(['name' => 'الفصل الثاني', 'start_date' => '2023-01-15', 'end_date' => '2024-06-06']);

        $class = StudyClass::create([
            'name' => "السابع",
        ]);
        $class->classrooms()->create(['name' => 'الأولى', 'capacity' => '30', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الثانية', 'capacity' => '25', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الثالثة', 'capacity' => '20', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الرابعة', 'capacity' => '3', 'year_id' => '1']);

        $class = StudyClass::create([
            'name' => "الثامن",
        ]);
        $class->classrooms()->create(['name' => 'الأولى', 'capacity' => '30', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الثانية', 'capacity' => '25', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الثالثة', 'capacity' => '20', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الرابعة', 'capacity' => '3', 'year_id' => '1']);
        $class = StudyClass::create([
            'name' => "التاسع",
        ]);
        $class->classrooms()->create(['name' => 'الأولى', 'capacity' => '30', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الثانية', 'capacity' => '25', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الثالثة', 'capacity' => '20', 'year_id' => '1']);
        $class->classrooms()->create(['name' => 'الرابعة', 'capacity' => '3', 'year_id' => '1']);

        Subject::create(['name' => 'اللغة العربية']);
        Subject::create(['name' => 'اللغة الفرنسية']);
        Subject::create(['name' => 'الغة الانكليزية']);
        Subject::create(['name' => 'التربية الدينية']);
        Subject::create(['name' => 'المعلوماتية']);
        Subject::create(['name' => 'الموسيقى']);

        $subject = Subject::create(['name' => 'الرياضيات']);
        $subject->sections()->create(['name' => 'الجبر']);
        $subject->sections()->create(['name' => 'الهندسة']);

        Subject::create(['name' => 'العلوم العامة ']);
        $subject->sections()->create(['name' => 'الفيزياء و الكيمياء']);
        $subject->sections()->create(['name' => 'العلوم']);
    }
}
