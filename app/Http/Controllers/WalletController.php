<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWalletRequest;
use App\Repositories\WalletRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected $repository;

    use ResponseTrait;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateWalletAsAdmin(UpdateWalletRequest $request, int $walletId): JsonResponse
    {
        $payload = $request->validated();
        $this->repository->updateWallet($payload, $walletId);

        return $this->success();
    }
}
