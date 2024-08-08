<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarkType extends Model
{
    protected $fillable = ['name', 'percentage'];

    protected $hidden = ['created_at', 'updated_at'];

    public function mark()
    {
        return $this->hasMany(Mark::class);
    }
}
