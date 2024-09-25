<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_SURNAME = 'surname';

    protected $table = 'administrator';
    protected $primaryKey = self::FIELD_ID;

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_SURNAME,
    ];
    
    use HasFactory;
}