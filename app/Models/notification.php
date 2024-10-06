<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'content', 'semester_id','user_role_id', 'is_read', 'type_content', 'type_content_id'];

    public function semesterUser()
    {
        return $this->belongsTo(semesterUser::class);
    }
}
