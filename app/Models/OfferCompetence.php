<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class OfferCompetence extends Authenticatable implements JWTSubject
{
    public const FIELD_ID = 'id';
    public const FIELD_OFFER_ID = 'offer_id';
    public const FIELD_COMPETENCE_ID = 'competence_id';

    protected $table = 'offercompetence';

    protected $fillable = [
        self::FIELD_STUDENT_ID,
        self::FIELD_COMPETENCE_ID,
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
