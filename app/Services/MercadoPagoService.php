<?php


namespace App\Services;


use App\Contracts\PaymentContract;
use App\Enums\SaleEnum;
use App\Enums\Services\MercadoPagoEnum;
use App\Models\Sale;
use App\Models\User;
use App\Transformers\MercadoPagoTransformer;
use App\Transformers\PaymentTransformer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;

class MercadoPagoService implements PaymentContract
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

    public function getSaleById(int $id)
    {
        $uri = $this->url . "/$id";

        try {
            $request = $this->client->request('GET', $uri);
            return json_decode($request->getBody(), true);
        } catch (ClientException $ex) {
            return json_decode($ex->getResponse()->getBody(), true);
        }
    }

    public function makePayment(array $payload)
    {
        $transactPayload = (new MercadoPagoTransformer())
            ->getMercadoPagoSchema($payload);

        try {
            $request = $this->client->request('POST', $this->url, ['body' => json_encode($transactPayload)]);
            return json_decode($request->getBody(), true);
        } catch (ClientException $ex) {
            return json_decode($ex->getResponse()->getBody(), true);
        }
    }

    public function handleCallback(array $payload): array
    {
        $sale = $this->getSaleById($payload['data']['id']);
        $sale_id = $sale['external_reference'];
        $statusMP = $sale['status'];

        $status = match ($statusMP) {
            'pending' => SaleEnum::PENDENT,
            'approved' => SaleEnum::APPROVED,
            'cancelled' => SaleEnum::CANCELED
        };

        return (new PaymentTransformer())->callbackPaymentSchema($status, $sale_id, $sale);
    }

    public function handleResponse($payment_method, $response)
    {
        $response = (array)$response;

        if (isset($response['status']) && is_int($response['status']) && $response['status'] != 200) {
            return ['error' => true, 'message' => $response['message']];
        }

        $response = match ($payment_method) {
            'pix' => (new MercadoPagoTransformer())->getPixOutput($response)
        };

        return $response;
    }
}
