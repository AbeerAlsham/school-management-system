<?php

namespace App\Models\Accounts;

use App\Enums\StudyLevel;
use App\Enums\University;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'father_name',
        'mother_name',
        'study_level',
        'university',
        'last_name',
        'national_number',
        'family_book_number'
    ];
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->father_name} {$this->last_name}";
    }
    protected function casts(): array
    {
        return [
            'university' => University::class,
            'study_level' => StudyLevel::class
        ];
    }
}
