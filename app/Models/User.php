<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public static function create(array $attributes = [])
    {
        // Hash the password before saving
        if (isset($attributes[self::FIELD_PASSWORD])) {
            $attributes[self::FIELD_PASSWORD] = password_hash($attributes[self::FIELD_PASSWORD], PASSWORD_BCRYPT);
        }

        return parent::create($attributes);
    }
}
