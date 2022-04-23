<?php

namespace App\Repositories;

use App\Contracts\PaymentContract;
use App\Enums\SaleEnum;
use App\Enums\Services\MercadoPagoEnum;
use App\Exceptions\Payment\InvalidPaymentMethodException;
use App\Exceptions\Payment\PaymentException;
use App\Exceptions\PaymentErrorException;
use App\Models\Sale;
use App\Services\MercadoPagoService;
use App\Transformers\MercadoPagoTransformer;
use App\Transformers\PaymentTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentRepository
{
    private StoreRepository $storeRepository;
    private MercadoPagoService $mercadoPagoService;

    public function __construct(StoreRepository $storeRepository, MercadoPagoService $mercadoPagoService)
    {
        $this->storeRepository = $storeRepository;
        $this->mercadoPagoService = $mercadoPagoService;
    }

    /**
     * @throws InvalidPaymentMethodException
     * @throws PaymentException
     * @throws PaymentErrorException
     */
    public function executeTransaction(array $payload): array
    {
        $this->validatePaymentMethod($payload['payment_method']);
        $totalCartValue = $this->storeRepository->getTotalCartValue();
        $cartCourses = $this->storeRepository->getCartCourses();
//        Session::remove('cart');

        if ($totalCartValue <= 0) {
            throw new PaymentException("Unable to execute transaction with a value less than 0");
        }

        $user = Auth::user();

        $sale = $user->sales()->create([
            'value' => $totalCartValue,
            'credits' => 1,
            'payment_method' => $payload['payment_method'],
            'status' => SaleEnum::PENDENT
        ]);

        foreach ($cartCourses as $course) {
            $sale->courses()->attach(['course_id' => $course->id, 'value' => $course->price]);
        }

        $payPayload = (new PaymentTransformer())
            ->paymentSchema(
                $sale,
                $totalCartValue,
                $cartCourses,
                $payload['payment_method'],
                $user
            );

        $service = $this->getServiceByPaymentMethod($payload['payment_method']);
        $payment = $service->makePayment($payPayload);

        $sale->logs()->create(['field' => 'response_send_' . $payload['provider'], 'value' => json_encode($payment)]);
        return $this->handlePaymentResponse($payload['payment_method'], $service, $payment);
    }

    /**
     * @throws PaymentErrorException
     */
    private function handlePaymentResponse($payment_method, PaymentContract $service, $response): array
    {
        $responseValidated = $service->handleResponse($payment_method, $response);

        if (isset($responseValidated['error'])) {
            throw new PaymentErrorException("Ocorreu um erro ao processar o pagamento, tente novamente mais tarde");
        }

        return $responseValidated;
    }

    public function handlePaymentCallback(array $payload): array
    {
        $service = $this->getServiceByProvider($payload['provider']);
        $response = $service->handleCallback($payload);

        $sale = Sale::find($response['sale_id'])->first();
        $sale->update(['status' => $response['sale_status']]);

        return ['ok' => true];
    }

    /**
     * @throws InvalidPaymentMethodException
     */
    private function validatePaymentMethod($method)
    {
        $valid_methods = ['ccr', 'pix'];

        if (!array_search($method, $valid_methods)) {
            throw new InvalidPaymentMethodException("The method " . $method . " is invalid");
        }
    }

    private function getServiceByPaymentMethod(string $method): PaymentContract
    {
        return match ($method) {
            'pix' => new MercadoPagoService()
        };
    }

    private function getServiceByProvider($provider): PaymentContract
    {
        return match ($provider) {
            'mercadopago' => new MercadoPagoService()
        };
    }
}
