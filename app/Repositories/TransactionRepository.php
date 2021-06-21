<?php


namespace App\Repositories;


use App\Exceptions\NoCreditsException;
use App\Exceptions\TransactionDeniedException;
use App\Http\Controllers\Notification\NotificationController;
use App\Models\Transactions\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\TransactionSuccessNotification;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    protected $model;

    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    /**
     * @throws TransactionDeniedException
     * @throws NoCreditsException
     */
    public function handleTransaction(array $payload)
    {
        $payee = $this->retrievePayee($payload);

        $myWallet = $this->getMyWallet();

        if (!$this->checkUserWalletBalance($myWallet, $payload["amount"])) {
            throw new NoCreditsException('Você não possui créditos suficientes', 422);
        }

        if ($this->transactionIsForMe($payload)) {
            throw new TransactionDeniedException('Você não pode tranferir para você mesmo', 422);
        }

        return $this->makeTransaction($payee, $payload);
    }

    private function makeTransaction($payee, array $data)
    {
        $payload = [
            'payer_wallet_id' => Auth::user()->wallet->id,
            'payee_wallet_id' => $payee->wallet->id,
            'amount' => $data["amount"]
        ];

        return DB::transaction(function () use ($payload, $payee) {
            $transaction = Transaction::create($payload);

            $transaction->walletPayer->withdraw($payload['amount']);
            $transaction->walletPayee->deposit($payload['amount']);

            $payee->notify(new TransactionSuccessNotification($payload, Auth::user()->name));

            (new NotificationController())->new($payee->id, "Você recebeu " . $payload["amount"] . " Lunapoints");

            return $transaction;
        });
    }

    public function retrievePayee(array $data)
    {
        return User::where('username', $data["payee_username"])->first();
    }

    private function checkUserWalletBalance(Wallet $wallet, $amount): bool
    {
        return $wallet->credits >= $amount;
    }

    private function getMyWallet()
    {
        return Auth::user()->wallet;
    }

    private function transactionIsForMe($payload): bool
    {
        return Auth::user()->username == $payload["payee_username"];
    }

    public function getUserLoggedTransactions()
    {
        $receipts = Transaction::where('payee_wallet_id', Auth::user()->wallet->id)
            ->with('walletPayer.user')
            ->get();

        $transactions = Transaction::where('payer_wallet_id', Auth::user()->wallet->id)
            ->with('walletPayee.user')
            ->get();


        return ['transactions' => $transactions, 'receipts' => $receipts];
    }


}
