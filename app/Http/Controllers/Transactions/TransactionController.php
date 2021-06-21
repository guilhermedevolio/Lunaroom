<?php

namespace App\Http\Controllers\Transactions;

use App\Exceptions\NoCreditsException;
use App\Exceptions\TransactionDeniedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostTransactionRequest;
use App\Models\Transactions\Transaction;
use App\Repositories\TransactionRepository;
use App\Traits\ResponseTrait;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    protected TransactionRepository $repository;

    use ResponseTrait;

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postTransaction(PostTransactionRequest $request): JsonResponse
    {
        $payload = $request->validated();

        try {
            $transaction = $this->repository->handleTransaction($payload);
            return response()->json($transaction);
        } catch (NoCreditsException | TransactionDeniedException $ex) {
            return response()->json(['msg' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function getUserLoggedTransactions(): View
    {
       $transactions = $this->repository->getUserLoggedTransactions();
       return view('campus.transactions.my-transactions', compact('transactions'));
    }
}
