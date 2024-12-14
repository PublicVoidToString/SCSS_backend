<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_STUDENT_ID = 'student_id';
    public const FIELD_OFFER_ID = 'offer_id';

    public const FIELD_CV = 'cv';

    protected $table = 'applications';
    protected $primaryKey = self::FIELD_ID;

    protected $fillable = [
        self::FIELD_STUDENT_ID,
        self::FIELD_OFFER_ID,
        self::FIELD_CV,
    ];
    
    use HasFactory;
}