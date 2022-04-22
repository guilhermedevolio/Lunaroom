<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'value', 'payment_method', 'credits', 'withdraw'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany('sales_log', 'sale_id', 'id');
    }
}
