<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pracodawca extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    public const FIELD_EMAIL = 'email';
    public const FIELD_PASSWORD = 'haslo';
    public const FIELD_BUSINESS_NAME = 'nazwa_firmy';
    public const FIELD_NIP = 'nip';
    public const FIELD_PHOTO = 'zdjecie';
    public const FIELD_DESCRIPTION = 'opis';


    protected $table = 'pracodawca';

    protected $fillable = [
        self::FIELD_EMAIL,
        self::FIELD_PASSWORD,
        self::FIELD_BUSINESS_NAME,
        self::FIELD_NIP,
        self::FIELD_PHOTO,
        self::FIELD_DESCRIPTION,
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
