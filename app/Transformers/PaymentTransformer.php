<?php


namespace App\Transformers;


use App\Enums\Services\MercadoPagoEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentTransformer
{
    public function paymentSchema($sale_id, $total, $product_name, $payment_method, User $payer)
    {
        return [
            'sale_id' => $sale_id,
            'total' => 10,
            'product' => $product_name,
            'payment_method' => $payment_method,
            'payer' => $payer
        ];
    }

    public function creditCardResponse($response)
    {

    }

    public function pixPaymentSchema($payment_method, $status, $qr_code, $qr_code_image): array
    {
        return (array) [
            'payment_method' => $payment_method,
            'status' => $status,
            'qr_code' => $qr_code,
            'qr_code_image' => $qr_code_image
        ];
    }
}
