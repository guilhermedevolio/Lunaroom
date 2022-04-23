<?php


namespace App\Transformers;


use App\Models\User;
use Carbon\Carbon;

class MercadoPagoTransformer
{
    public function getCustomerSchema(User $user): array
    {
        return [
            'email' => "elainenogaroto@gmail.com",
            'first_name' => $user->name,
            'last_name' => $user->name,
            'identification' => [
                'type' => 'CPF',
                "number" => '21094091855'
            ]
        ];
    }

    public function getMercadoPagoSchema(array $payload): array
    {
        return [
            "transaction_amount" => (float) $payload['total'],
            'description' => "Sale " . Carbon::now(),
            'items' => $payload['items'],
            'external_reference' => $payload['sale']->id,
            'notification_url' => 'https://c1dd-2804-14d-8472-8036-1585-4ec9-388e-94cd.sa.ngrok.io/callback/payment/mercadopago',
            'payment_method_id' => $payload['payment_method'],
            'payer' => $this->getCustomerSchema($payload['payer'])
        ];
    }

    public function getPixOutput($response)
    {
        return (new PaymentTransformer())->pixPaymentSchema(
            'pix',
            $response['status'],
            $response['point_of_interaction']['transaction_data']['qr_code'],
            $response['point_of_interaction']['transaction_data']['qr_code_base64']);
    }
}
