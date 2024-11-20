<?php

namespace App\Models\Document;

use App\Models\AcademicYear\Semester;
use App\Models\Class\Classroom ;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ExamProgram extends Model
{
    protected $fillable = ['classroom_id', 'semester_id', 'program_path'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function setProgramPathAttribute($file)
    {
        if ($file) { // تأكد من وجود ملف
            // حذف الصورة القديمة إذا كانت موجودة
            if (isset($this->attributes['program_path']) && Storage::disk('public')->exists($this->attributes['program_path'])) {
                Storage::disk('public')->delete($this->attributes['program_path']);
            }
            $filePath = 'ExamPrograms/';
            $uniqueFileName = md5(time()) . '.' . $file->getClientOriginalName();
          return  $this->attributes['program_path'] = $file->storeAs($filePath, $uniqueFileName, 'public');
        }
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($exam_program) {
            // تأكد من وجود الملف قبل محاولة حذفه
            if (Storage::disk('public')->exists($exam_program->program_path)) {
                Storage::disk('public')->delete($exam_program->program_path);
            }
        });
    }
}
