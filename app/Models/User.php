<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_login',
        'google_id',
        'facebook_id',
        'name',
        'email',
        'password',
        'status',
        'role',
        'token',
        'time_life_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'facebook_id',
        'google_id',
        'password',
        'remember_token',
        'token',
        'time_life_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ROLE = [
        "CANDIDATE" => 1,
        "EMPLOYER" => 2,
    ];

    public static $role_text = [
        self::ROLE['CANDIDATE'] => "Người ứng tuyển",
        self::ROLE['EMPLOYER'] => "Nhà tuyển dụng",
    ];

    public function getRoleTextAttribute() {
        return self::$role_text[$this->role];
    }

    public function userInfo() {
        return $this->hasOne(UserInfo::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function company() {
        return $this->hasOne(Company::class);
    }
}