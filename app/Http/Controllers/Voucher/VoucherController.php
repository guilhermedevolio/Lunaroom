<?php

namespace App\Http\Controllers\Voucher;

use App\Exceptions\VoucherDeniedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostVoucherRequest;
use App\Http\Requests\RedeemVoucherRequest;
use App\Models\Voucher\Voucher;
use App\Repositories\VoucherRepository;
use App\Traits\ResponseTrait;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class VoucherController extends Controller
{
    private VoucherRepository $repository;
    use ResponseTrait;

    public function __construct(VoucherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewCreateVoucher(): View
    {
        return view('admin.voucher.new');
    }

    public function viewRedeemVoucher(): View
    {
        return view('campus.voucher.redeem');
    }

    public function postVoucher(PostVoucherRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $voucher = $this->repository->createVoucher($payload);

        return $this->success(['voucher' => $voucher["voucher"] ]);
    }

    public function redeemVoucher(RedeemVoucherRequest $request)
    {

        $payload = $request->validated();

        try{
            $voucher_amount = $this->repository->handleRedeemVoucher($payload);
            return $this->success(['amount' => $voucher_amount]);
        } catch (VoucherDeniedException $ex) {
            return response()->json(['msg' => $ex->getMessage()], $ex->getCode());
        }

    }



}
