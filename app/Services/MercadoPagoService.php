<?php


namespace App\Services;



use App\Enums\Services\MercadoPagoEnum;
use App\Models\User;
use App\Transformers\MercadoPagoTransformer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;

class MercadoPagoService
{
    private Client $client;
    private string $access_token;

    public function __construct()
    {
        $this->access_token = "TEST-5708692522992388-041615-74597e7a2b1ba21ba2459dd81197eaa8-387855747";
        $this->url = 'https://api.mercadopago.com/v1/payments';

        $this->client = new Client([
            'base_url' => $this->url,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->access_token
            ]
        ]);
    }

    public function generatePixPaymentTest() {

        $payPayload = [
            'total' => 10,
            'product' =>  "300 Lunapoints",
            'payment_method' => MercadoPagoEnum::METHOD_PIX,
            'payer' => Auth::user()
        ];

        $payload = (new MercadoPagoTransformer())->getMercadoPagoSchema($payPayload);

        try {
            $request = $this->client->request('POST', $this->url, ['body' => json_encode($payload)]);
            return json_decode($request->getBody());
        } catch (ClientException $ex) {
            return json_decode($ex->getResponse()->getBody(), true);
        }

    }
}
