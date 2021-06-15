<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
       'module_id', 'title', 'description', 'provider_video', 'video_link', 'init_date'
    ];
}
