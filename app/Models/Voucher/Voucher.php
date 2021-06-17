<?php

namespace App\Models\Voucher;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected  $table = "vouchers";

    protected $fillable = [
        'id', 'voucher', 'amount', 'used'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
