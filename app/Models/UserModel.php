<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class UserModel extends Model implements JWTSubject
{
    protected $table = "users";

    protected $fillable = [
        'id',
        'name',
        'is_admin',
        'is_banned',
        'ban_reason',
        'skin_path',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
