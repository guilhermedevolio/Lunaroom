<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(int[] $array, int[] $array1)
 */
class UserCourse extends Model
{
    use HasFactory;

    protected $table = 'users_courses';

    protected $fillable = ['id', 'user_id', 'course_id', 'credits', 'joined_at'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
