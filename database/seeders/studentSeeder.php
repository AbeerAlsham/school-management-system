<?php

namespace Database\Seeders;

use App\Models\Accounts\User;
use App\Models\studentClass;
use App\Models\studentClassroom;
use App\Models\Students\Father;
use App\Models\Students\Mother;
use App\Models\Students\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // بيانات الطلاب
        $studentsData = [
            [
                'father' => ['name' => 'أحمد', 'parent_name'=>'mmmmm','last_name' => 'العلي', 'study_level' => 'ثانوية', 'work' => 'مهندس'],
                'mother' => ['name' => 'فاطمة', 'last_name' => 'العلي', 'study_level' => 'جامعية', 'work' => 'دكتورة'],
                'guardian' => ['username' => 'علي', 'password' => '123456'],
                'student' => [
                    // 'photo' => 'path/to/photo1.jpg',
                    'public_registry_number' => '256352',
                    'first_name' => 'عبد الكريم',
                    'last_name' => 'العلي',
                    'birth_address' => 'دوما',
                    'birthdate' => '2010-01-01',
                    'registration_place' => 'عربين',
                    'registration_number' => '275690',
                    'religion' => 'مسلم',
                    'nationality' => 'عربي سوري',
                    'chronic_diseases' => 'لا يوجد',
                    'national_number' => '01332469363'
                ]
            ],
            // يمكنك إضافة المزيد من الطلاب هنا
            [
                'father' => ['name' => 'محمد', 'last_name' => 'الأسد', 'parent_name'=>'mmmmm', 'study_level' => 'جامعي', 'work' => 'محامي'],
                'mother' => ['name' => 'عائشة', 'last_name' => 'الأسد', 'study_level' => 'ثانوية', 'work' => 'معلمة'],
                'guardian' => ['username' => 'سالم', 'password' => '654321'],
                'student' => [
                    // 'photo' => 'path/to/photo2.jpg',
                    'public_registry_number' => '256353',
                    'first_name' => 'سليم',
                    'last_name' => 'الأسد',
                    'birth_address' => 'دمشق',
                    'birthdate' => '2011-02-02',
                    'registration_place' => 'مخيم اليرموك',
                    'registration_number' => '275691',
                    'religion' => 'مسلم',
                    'nationality' => 'عربي سوري',
                    'chronic_diseases' => 'لا يوجد',
                    'national_number' => '01332469364'
                ]
            ],
        ];

        foreach ($studentsData as $data) {


            // إنشاء الوصي
            $guardian = User::create([
                'username' => $data['guardian']['username'],
                'password' => bcrypt($data['guardian']['password']) // تأكد من تشفير كلمة المرور
            ]);

            // إنشاء الطالب
            $student = Student::create($data['student']);

            // ربط الطالب بالأب والأم والوصي
            $student->father()->create($data['father']);
            $student->mother()->create($data['mother']);
            $student->guardian()->attach($guardian->id, ['kinship' => 'عم']);
            // إضافة معلومات المدرسة السابقة
            $student->lastSchool()->create([
                'school_name' => 'مدرسة الأمل',
                'school_address' => 'دوما، سوريا',
                'previous_result' => 'ناجح',
                'failed_grades' => 'لا يوجد',
            ]);

            // إضافة الإخوة
            $student->siblings()->createMany([
                ['name' => 'محمد', 'study_level' => 'عاشر'],
                ['name' => 'حنان', 'study_level' => 'سابع'],
            ]);

            // إنشاء student_class
            $studentClass = studentClass::create([
                'student_id' => $student->id,
                'study_class_id' => 1, // تأكد من أن هذا هو ID الصف الدراسي الصحيح
                'study_year_id' => 1, // تأكد من أن هذا هو ID السنة الدراسية الصحيح
                'status' => 'مسجل'
            ]);

            // إضافة الطالب إلى الشعبة
            studentClassroom::create([
                'classroom_id' => 1, // تأكد من أن هذا هو ID الشعبة الصحيح
                'student_class_id' => $studentClass->id,
                'serial_number' => 1 // يمكنك تغيير الرقم التسلسلي حسب الحاجة
            ]);
        }
    }
}
