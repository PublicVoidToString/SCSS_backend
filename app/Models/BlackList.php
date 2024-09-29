<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    public const FIELD_ID = 'id';
    public const FIELD_USER_ID = 'user_id';

    protected $table = 'blacklist';
    protected $primaryKey = self::FIELD_ID;

    protected $fillable = [
        self::FIELD_USER_ID,
    ];
    
    use HasFactory;
}