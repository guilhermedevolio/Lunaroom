<?php


namespace App\Transformers;


use App\Models\User;

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
            'description' => (string) $payload['product'],
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
