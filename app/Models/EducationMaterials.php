<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EducationMaterials extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_CAREER_OFFICE_ID = 'career_office_id';
    public const FIELD_TITLE = 'title';
    public const FIELD_DESCRIPTION = 'description';

    protected $table = 'education_materials';

    protected $fillable = [
        self::FIELD_CAREER_OFFICE_ID,
        self::FIELD_TITLE,
        self::FIELD_DESCRIPTION,

    ];
    public function careerOffice()
    {
        return $this->belongsTo(CareerOffice::class);
    }
    use HasFactory;
}
