<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Administrator extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public const FIELD_ID = 'id';
    public const FIELD_EMAIL = 'email';
    public const FIELD_HASLO = 'haslo';
    public const FIELD_IMIE = 'imie';
    public const FIELD_NAZWISKO = 'nazwisko';
    public const FIELD_NR_TELEFONU = 'nr_telefonu';

    protected $table = 'administrator';
    protected $primaryKey = self::FIELD_ID;

    protected $fillable = [
        self::FIELD_EMAIL,
        self::FIELD_HASLO,
        self::FIELD_IMIE,
        self::FIELD_NAZWISKO,
        self::FIELD_NR_TELEFONU,
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