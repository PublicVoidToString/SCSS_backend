<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Role extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    public const FIELD_ROLE = 'role';

    protected $table = 'role';

    protected $fillable = [
        self::FIELD_ROLE
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    use HasFactory;
}
