<?php

namespace App\Models\AssignmentUser;

use Illuminate\Database\Eloquent\Model;
use App\Models\Class\StudyClass;
use App\Models\Class\Classroom;
class AssignmentSupervisor extends Model
{
   protected $fillable=['semester_user_id','class_id','classroom_id'];

   public function semesterUser()
   {
       return $this->belongsTo(SemesterUser::class);
   }

   public function studyClass()
   {
       return $this->belongsTo(StudyClass::class, 'class_id');
   }

   public function classroom()
   {
       return $this->belongsTo(Classroom::class);
   }

}
