<?php

namespace App\Models\Profile;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'image', 'active', 'linkedin_url', 'discord_nick', 'github_url', 'website_url', 'biography'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
