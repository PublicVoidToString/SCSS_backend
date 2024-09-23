<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCompetence extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_STUDENT_ID = 'student_id';
    public const FIELD_COMPETENCE_ID = 'competence_id';

    protected $table = 'student_competence';

    protected $fillable = [
        self::FIELD_STUDENT_ID,
        self::FIELD_COMPETENCE_ID,
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, self::FIELD_STUDENT_ID);
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class, self::FIELD_COMPETENCE_ID);
    }

    use HasFactory;
}
