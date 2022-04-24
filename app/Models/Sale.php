<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'value', 'status', 'payment_method', 'withdraw'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(SaleLog::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'sales_courses',
            'sale_id',
            'course_id'
        )->withPivot(['value']);
    }
}
