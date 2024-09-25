<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    use HasFactory;

    public const FIELD_ID = 'id';
    public const FIELD_CAREER_OFFICE_ID = 'careeroffice_id';
    public const FIELD_EMPLOYER_ID = 'employer_id';

    protected $table = 'collaboration';

    protected $fillable = [
        self::FIELD_EMPLOYER_ID,
        self::FIELD_CAREER_OFFICE_ID,
    ];

    public function careerOffice()
    {
        return $this->belongsTo(CareerOffice::class, self::FIELD_CAREER_OFFICE_ID);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class, self::FIELD_EMPLOYER_ID);
    }
}