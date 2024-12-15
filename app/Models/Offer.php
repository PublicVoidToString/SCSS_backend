<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_EMPLOYER_ID = 'employer_id';
    public const FIELD_TITLE = 'title';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_EXPIRATION_DATE = 'expiration_date';
    public const FIELD_CREATED_DATE = 'created_date';
    public const FIELD_OFFER_TYPE_ID = 'offer_type_id';

    protected $table = 'offer';

    protected $fillable = [
        self::FIELD_EMPLOYER_ID,
        self::FIELD_TITLE,
        self::FIELD_DESCRIPTION,
        self::FIELD_EXPIRATION_DATE,
        self::FIELD_OFFER_TYPE_ID,
    ];

    use HasFactory;

    public function employer()
    {
        return $this->belongsTo(Employer::class, self::FIELD_EMPLOYER_ID);
    }

    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'offer_competence',
            'offer_id',
            'competence_id'
        );
    }

    public function offerType()
    {
        return $this->belongsTo(OfferType::class, self::FIELD_OFFER_TYPE_ID);
    }
}
