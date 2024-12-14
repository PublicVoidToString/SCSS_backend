<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class QuizResult extends Model
{
    use HasFactory;

    protected $table = 'quiz_results';

    protected $fillable = [
        'student_id',
        'frontend_points',
        'backend_points',
        'devops_points',
        'data_science_points',
        'cybersecurity_points',
        'questions_data',
    ];

    // Relacja z użytkownikiem (studentem)
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id'); // 'student_id' to klucz obcy
    }
}
