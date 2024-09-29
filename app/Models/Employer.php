<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    public const VERIFIED = 1;
    public const NOT_VERIFIED = 0;

    public const FIELD_ID = 'id';
    public const FIELD_COMPANY_NAME = 'companyname';
    public const FIELD_KRS_NUMBER = 'krsnumber';
    public const FIELD_VERIFIED = 'verified';


    protected $table = 'employer';

    protected $fillable = [
        self::FIELD_COMPANY_NAME,
        self::FIELD_KRS_NUMBER,
        self::FIELD_VERIFIED,
    ];

    use HasFactory;
}
