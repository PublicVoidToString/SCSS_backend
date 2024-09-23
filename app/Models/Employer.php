<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employer extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    public const FIELD_COMPANY_NAME = 'companyname';
    public const FIELD_KRS_NUMBER = 'krsnumber';

    protected $table = 'employer';

    protected $fillable = [
        self::FIELD_COMPANY_NAME,
        self::FIELD_KRS_NUMBER,
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
