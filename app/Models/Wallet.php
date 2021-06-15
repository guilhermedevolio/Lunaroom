<?php

namespace App\Models;

use App\Models\Transactions\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'credits'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deposit($value): bool
    {
        return $this->update([
            'credits' => $this->attributes['credits'] + $value
        ]);
    }

    public function withDraw($value): bool
    {
        return $this->update([
            'credits' => $this->attributes['credits'] - $value
        ]);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'payer_wallet_id', 'id');
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(Transaction::class, 'payee_wallet_id', 'id');
    }
}
