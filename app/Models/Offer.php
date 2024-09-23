<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Offer extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    public const FIELD_EMPLOYER_ID = 'employer_id';
    public const FIELD_TITLE = 'title';
    public const FIELD_DESCRIPTION = 'description';


    protected $table = 'offer';

    protected $fillable = [
        self::FIELD_EMPLOYER_ID,
        self::FIELD_TITLE,
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

    public function employer()
    {
        return $this->belongsTo(Employer::class, self::FIELD_EMPLOYER_ID);
    }
}
