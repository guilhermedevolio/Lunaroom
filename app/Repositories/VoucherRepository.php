<?php


namespace App\Repositories;


use App\Exceptions\VoucherDeniedException;
use App\Models\Voucher\Voucher;
use Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class VoucherRepository
{
    private Voucher $model;

    public function __construct(Voucher $model)
    {
        $this->model = $model;
    }

    public function createVoucher(array $payload)
    {
        $payload["voucher"] = $this->generateVoucher();
        return $this->model->create($payload);
    }

    public function generateVoucher(): string
    {
        return Uuid::uuid4()->toString();
    }

    public function handleRedeemVoucher(array $payload)
    {
        $voucher = $this->checkVoucherIsUsed($payload["voucher"]);


        if (!$voucher) {
            throw new VoucherDeniedException('O Voucher Informado já foi resgatado', 422);
        }

        return DB::transaction(function () use ($voucher) {
            Auth::user()->wallet->deposit($voucher['amount']);
            $voucher->update(['used' => Auth::user()->id]);

            return $voucher["amount"];
        });
    }


    public function checkVoucherIsUsed(string $voucher)
    {
        $voucher = Voucher::where('voucher', $voucher)->first();

        if ($voucher["used"]) {
            return false;
        }

        return $voucher;
    }
}
