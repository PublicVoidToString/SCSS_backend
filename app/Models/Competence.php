<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Competence extends Model  
{
    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'description';

    protected $table = 'competence';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_DESCRIPTION,
    ];

    use HasFactory;
}
