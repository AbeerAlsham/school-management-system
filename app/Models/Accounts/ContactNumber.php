<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\User;

class ContactNumber extends Model
{
    protected $fillable=['phone_number'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
