<?php

namespace App\Models;

use App\Models\Notification\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * @method create(array $payload)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        return $this->attributes["password"] = Hash::make($value);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'users_courses', 'user_id', 'course_id');
    }


}
