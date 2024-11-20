<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class ContactNumber extends Model
{
    protected $fillable=['phone_number'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
