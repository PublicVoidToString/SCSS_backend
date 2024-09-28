<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_STUDENT = 1;
    public const ROLE_EMPLOYER = 2;
    public const ROLE_CAREEROFFICE = 3;
    public const ROLE_ADMINISTRATOR = 4;

    public const FIELD_ID = 'id';
    public const FIELD_EMAIL = 'email';
    public const FIELD_PASSWORD = 'password';
    public const FIELD_DATA_ID = 'data_id';
    public const FIELD_ROLE_ID = 'role_id';

    protected $table = 'users';

    protected $fillable = [
        self::FIELD_EMAIL,
        self::FIELD_PASSWORD,
        self::FIELD_DATA_ID,
        self::FIELD_ROLE_ID,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function data()
    {
        switch ($this->role_id) {
            case self::ROLE_STUDENT:
                return $this->belongsTo(Student::class, 'data_id');
            case self::ROLE_EMPLOYER:
                return $this->belongsTo(Employer::class, 'data_id');
            case self::ROLE_ADMINISTRATOR:
                return $this->belongsTo(Administrator::class, 'data_id');
            case self::ROLE_CAREEROFFICE:
                return $this->belongsTo(CareerOffice::class, 'data_id');
            default:
                return null;
        }
    }

    public static function create(array $attributes = [])
    {
        return parent::create($attributes);
    }

}
