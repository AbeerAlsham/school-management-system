<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookDelivery extends Model
{
    protected $fillable = [
        'student_class_id',
        'book_id',
        'is_new_book',
        'is_delivered',
        'is_returned'
    ];

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
