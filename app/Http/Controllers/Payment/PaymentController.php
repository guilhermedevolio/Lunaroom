<?php

namespace App\Http\Controllers\Payment;

use App\Exceptions\Payment\InvalidPaymentMethodException;
use App\Exceptions\Payment\PaymentException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\ExecPaymentRequest;
use App\Repositories\PaymentRepository;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    private PaymentRepository $repository;

    public function __construct(PaymentRepository $repository)
    {

        $this->repository = $repository;
    }

    public function viewCheckout()
    {
        return view('campus.payment.checkout');
    }

    public function processPayment(ExecPaymentRequest $request)
    {
        try {
            $this->repository->executeTransaction($request->validated());
        } catch (InvalidPaymentMethodException $ex) {
            return response()->json(['status' => 'error', 'error' => $ex->getMessage()]);
        } catch (PaymentException $ex) {
            return response()->json(['status' => 'error', 'error' => $ex->getMessage()]);
        }
    }
}
