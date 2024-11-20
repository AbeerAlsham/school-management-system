<?php

namespace App\Models\Book;

use App\Models\AcademicYear\StudyYear;
use Illuminate\Database\Eloquent\Model;

class YearBook extends Model
{
    protected $fillable = [
        'book_id',
        'study_year_id',
        'book_available_new',
        'book_available_old',
        'book_delivered_new',
        'book_delivered_old'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function studyYear()
    {
        return $this->belongsTo(StudyYear::class);
    }
}
