<?php

namespace App\Http\Controllers\Payment;

use App\Exceptions\Payment\InvalidPaymentMethodException;
use App\Exceptions\Payment\PaymentException;
use App\Exceptions\PaymentErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\ExecPaymentRequest;
use App\Repositories\PaymentRepository;
use App\Services\MercadoPagoService;
use Illuminate\Http\JsonResponse;
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

    public function processPayment(ExecPaymentRequest $request): JsonResponse
    {
        try {
            $transaction = $this->repository->executeTransaction($request->validated());
            return response()->json(['status' => 'success', 'payment' => $transaction]);
        } catch (InvalidPaymentMethodException $ex) {
            return response()->json(['status' => 'error', 'error' => $ex->getMessage()]);
        } catch (PaymentException $ex) {
            return response()->json(['status' => 'error', 'error' => $ex->getMessage()]);
        } catch (PaymentErrorException $ex) {
            return response()->json(['status' => 'error', 'error' => $ex->getMessage()]);
        }
    }
}
