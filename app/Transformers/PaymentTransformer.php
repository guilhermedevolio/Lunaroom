<?php


namespace App\Transformers;


use App\Enums\SaleEnum;
use App\Enums\Services\MercadoPagoEnum;
use App\Models\Course;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentTransformer
{
    public function paymentSchema(Sale $sale, $total, $items, string $payment_method, User $payer)
    {
        return [
            'sale' => $sale,
            'total' => $total,
            'items' => $items,
            'payment_method' => $payment_method,
            'payer' => $payer
        ];
    }

    public function creditCardResponse($response)
    {

    }

    public function pixPaymentSchema($payment_method, $status, $qr_code, $qr_code_image): array
    {
        $payload = (array) [
            'payment_method' => $payment_method,
            'status' => $status,
            'qr_code' => $qr_code,
            'qr_code_image' => $qr_code_image,
        ];

        $payload['base64payload'] = base64_encode(json_encode($payload));

        return $payload;
    }

    public function callbackPaymentSchema($payment_status, $payment_id, $response): array
    {
        return (array) [
            'sale_id' => $payment_id,
            'sale_status' => $payment_status,
            'provider_response' => $response
        ];
    }

    public function friendlyPaymentStatus($status): string
    {

        return match ($status) {
            SaleEnum::APPROVED => "Aprovado",
            SaleEnum::PENDENT =>  "Aguardando Pagamento",
            SaleEnum::CANCELED => "Cancelado",
        };

    }
}
