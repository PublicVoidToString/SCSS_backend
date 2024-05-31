<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{

    public $timestamps = false;
    public const FIELD_ID = 'id';
    public const FIELD_PHOTO = 'zdjecie';
    public const FIELD_DESCRIPTION = 'opis';
    public const FIELD_COMPETENCE = 'kompetencje';
    
    protected $table = 'student';

    protected $fillable = [
        self::FIELD_PHOTO,
        self::FIELD_DESCRIPTION,
        self::FIELD_COMPETENCE,
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
