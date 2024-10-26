<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'is_yearly', 'class_subject_id'];

    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class);
    }

    public function bookDeliveries()
    {
        return $this->hasMany(BookDelivery::class,'book_id');
    }

    public function yearBook(){
        return $this->hasOne(YearBook::class,'book_id');
    }
}
