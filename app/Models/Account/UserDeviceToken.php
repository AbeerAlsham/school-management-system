<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class UserDeviceToken extends Model
{
    protected $fillable = ['device_token', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getTokenUsers($userRoleId)
    {
        $userRole = UserRole::find($userRoleId);

        if ($userRole) {
            // جلب user_id من userRole
            $userId = $userRole->user_id;
            // جلب device_tokens بناءً على user_id
            return self::where('user_id', $userId)->pluck('device_token')->toArray();
        }

        return [];
    }
}
