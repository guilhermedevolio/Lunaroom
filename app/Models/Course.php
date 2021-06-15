<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function modules(){
        return $this->hasMany(Module::class);
    }
}
