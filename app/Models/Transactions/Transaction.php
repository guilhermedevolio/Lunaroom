<?php

namespace App\Models\Transactions;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'wallet_transactions';

    protected $fillable = [
        'id',
        'payer_wallet_id',
        'payee_wallet_id',
        'amount'
    ];

    public function walletPayer()
    {
        return $this->belongsTo(Wallet::class, 'payer_wallet_id');
    }

    public function walletPayee()
    {
        return $this->belongsTo(Wallet::class, 'payee_wallet_id');
    }


}
