<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method findOrFail($moduleId)
 * @method create($payload)
 */
class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'name'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
