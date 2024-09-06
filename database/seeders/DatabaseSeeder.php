<?php

namespace Database\Seeders;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Support\Facades\Hash;
use App\Models\Accounts\User;
use App\Models\Classes\StudyClass;
use App\Models\ExamType;
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
            'username' => "supervisor",
            'password' => Hash::make(123456),
        ]);
        $user->roles()->attach(3);
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
        $StudyYear2->semesters()->create(['name' => 'الفصل الأول', 'start_date' => '2023-01-09', 'end_date' => '2024-01-01']);
        $StudyYear2->semesters()->create(['name' => 'الفصل الثاني', 'start_date' => '2023-01-15', 'end_date' => '2024-06-06']);

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

        Subject::create(['name' => 'اللغة العربية', 'min_mark' => 300, 'max_mark' => 600]);
        Subject::create(['name' => 'اللغة الفرنسية', 'min_mark' => 120, 'max_mark' => 300]);
        Subject::create(['name' => 'الغة الانكليزية', 'min_mark' => 180, 'max_mark' => 400]);
        Subject::create(['name' => 'التربية الدينية', 'min_mark' => 80, 'max_mark' => 200]);
        Subject::create(['name' => 'تكنولوجيا المعلومات و الاتصالات ', 'min_mark' => 80, 'max_mark' => 200]);
        Subject::create(['name' => 'التربية الفنية البصرية و الجمالية', 'min_mark' => 80, 'max_mark' => 200]);
        Subject::create(['name' => 'التربية الموسيقية', 'min_mark' => 80, 'max_mark' => 200]);
        Subject::create(['name' => 'التربية البدنية و الرياضة', 'min_mark' => 80, 'max_mark' => 200]);
        Subject::create(['name' => 'المشروع', 'min_mark' => 80, 'max_mark' => 200]);
        Subject::create(['name' => 'التربية المهنية', 'min_mark' => 80, 'max_mark' => 200]);
        Subject::create(['name' => 'السلوك', 'min_mark' => 80, 'max_mark' => 200]);

        $subject = Subject::create(['name' => 'الرياضيات' ,'min_mark' => 240, 'max_mark' => 600]);
        $subject->sections()->create(['name' => 'الجبر','max_mark'=>300]);
        $subject->sections()->create(['name' => 'الهندسة','max_mark'=>300]);

        $subject =Subject::create(['name' => 'العلوم العامة','min_mark' => 160 , 'max_mark' => 400]);
        $subject->sections()->create(['name' => 'الفيزياء و الكيمياء','max_mark' => 200]);
        $subject->sections()->create(['name' => 'العلوم', 'max_mark' => 200]);

        ExamType::create(['name' => 'شفهي', 'percentage' => 0.1]);
        ExamType::create(['name' => 'وظائف + أوراق عمل', 'percentage' => 0.1]);
        ExamType::create(['name' => 'نشاطات و مبادرات', 'percentage' => 0.2]);
        ExamType::create(['name' => 'المذاكرة', 'percentage' => 0.2]);
        ExamType::create(['name' => 'امتحان الفصل', 'percentage' => 0.4]);
    }
}
