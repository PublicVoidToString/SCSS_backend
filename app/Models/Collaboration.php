<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Collaboration extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    public const FIELD_CAREER_OFFICE_ID = 'careeroffice_id';
    public const FIELD_EMPLOYER_ID = 'employer_id';

    protected $table = 'collaboration';

    protected $fillable = [
        self::FIELD_EMPLOYER_ID,
        self::FIELD_CAREER_OFFICE_ID,
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function careerOffice()
    {
        return $this->belongsTo(CarrerOffice::class, self::FIELD_CAREER_OFFICE_ID);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class, self::FIELD_EMPLOYER_ID);
    }

    use HasFactory;
}
