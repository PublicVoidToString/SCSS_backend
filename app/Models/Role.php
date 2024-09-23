<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_ROLE = 'role';

    protected $table = 'role';

    protected $fillable = [
        self::FIELD_ROLE
    ];


    use HasFactory;
}
