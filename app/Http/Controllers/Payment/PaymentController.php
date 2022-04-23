<?php

namespace App\Http\Controllers\Payment;

use App\Exceptions\Payment\InvalidPaymentMethodException;
use App\Exceptions\Payment\PaymentException;
use App\Exceptions\PaymentErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\ExecPaymentRequest;
use App\Models\Sale;
use App\Repositories\PaymentRepository;
use App\Repositories\StoreRepository;
use App\Services\MercadoPagoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    private PaymentRepository $repository;
    private StoreRepository $storeRepository;

    public function __construct(PaymentRepository $repository, \App\Repositories\StoreRepository $storeRepository)
    {
        $this->repository = $repository;
        $this->storeRepository = $storeRepository;
    }

    public function viewCheckout()
    {
        if (!Session::get('cart')) {
            return redirect('campus');
        }

        $totalCartValue = $this->storeRepository->getTotalCartValue();
        return view('campus.payment.checkout', compact('totalCartValue'));
    }

    public function viewPayPix(string $payloadbase64)
    {
        $payloadbase64 = json_decode(base64_decode($payloadbase64), true);
        return view('campus.payment.pix', ['payload' => $payloadbase64]);
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
        } catch (Exception $ex) {
            return response()->json(['status' => 'error', 'error' => $ex->getMessage()]);
        }
    }

    public function handlePaymentCallback(string $provider, Request $request)
    {
        $payload = $request->all();
        $payload['provider'] = $provider;

        $sale = Sale::find(1)->first();
        $sale->logs()->create(['field' => 'callback', 'value' => json_encode($request->all())]);


        try {
            $this->repository->handlePaymentCallback($payload);
        } catch (Exception $ex) {

        }
    }
}
