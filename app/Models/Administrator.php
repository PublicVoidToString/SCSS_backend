<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Administrator extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_SURNAME = 'surname';

    protected $table = 'administrator';
    protected $primaryKey = self::FIELD_ID;

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_SURNAME,
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