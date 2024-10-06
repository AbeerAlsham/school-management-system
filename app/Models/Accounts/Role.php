<?php

namespace App\Models\Accounts;

use App\Models\Accounts\Profile;
use App\Models\Accounts\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function permessions()
    {

        return $this->belongsToMany(Permission::class, 'roles_permissions')->select('name');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'users');
    }


    public function hasPermession($permession)
    {
        return  $this->permessions->contains('name', $permession);
    }
}
