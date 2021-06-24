<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method create(array $payload)
 * @method findOrFail($courseId)
 */
class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'price'
    ];

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(UserCourse::class);
    }
}
