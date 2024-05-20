<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PracownikBiuraKarier extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    
    public const FIELD_EMAIL = 'email';
    
    public const FIELD_PASSWORD = 'haslo';


    protected $table = 'pracownikbiurakarier';

    protected $fillable = [
        self::FIELD_EMAIL,
        self::FIELD_PASSWORD,
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
