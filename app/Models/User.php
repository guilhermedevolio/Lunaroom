<?php

namespace App\Models;

use App\Models\Notification\Notification;
use App\Models\Profile\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method create(array $payload)
 * @method static where(string $string, mixed $user_id)
 * @method static findOrFail(mixed $user_id)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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

    public function setPasswordAttribute($value): string
    {
        return $this->attributes["password"] = Hash::make($value);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'users_courses',
            'user_id',
            'course_id'
        )->withPivot(['joined_at']);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }


}
