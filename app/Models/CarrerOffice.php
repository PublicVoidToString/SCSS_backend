<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CarrerOffice extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    public const FIELD_UNIVERSITY = 'university';

    protected $table = 'carrer_office';

    protected $fillable = [
        self::FIELD_UNIVERSITY
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
