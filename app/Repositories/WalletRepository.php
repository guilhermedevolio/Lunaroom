<?php


namespace App\Repositories;


use App\Http\Requests\UpdateWalletRequest;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

class WalletRepository
{
    protected $model;

    public function __construct(Wallet $model)
    {
        $this->model = $model;
    }

    public function updateWallet(array $payload, int $walletId): bool
    {
        return $this->model
            ->findOrFail($walletId)
            ->update($payload);
    }
}
