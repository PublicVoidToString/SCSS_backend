<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{

    public $timestamps = false;
    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_SURNAME = 'surname';
    public const FIELD_INDEX_NUMBER = 'indexnumber';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_PHOTO_URL = 'photourl';
    
    protected $table = 'student';

    protected $fillable = [
        self::FIELD_PHOTO_URL,
        self::FIELD_NAME,
        self::FIELD_SURNAME,
        self::FIELD_INDEX_NUMBER,
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
