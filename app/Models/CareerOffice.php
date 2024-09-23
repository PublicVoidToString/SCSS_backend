<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CareerOffice extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_UNIVERSITY = 'university';

    protected $table = 'carrer_office';

    protected $fillable = [
        self::FIELD_UNIVERSITY
    ];

    use HasFactory;
}
