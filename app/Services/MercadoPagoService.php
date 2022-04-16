<?php


namespace App\Services;



use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

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
        $payload = [
            "transaction_amount" => (float) 10,
            'description' => "300 Lunapoints",
            'payment_method_id' => 'pix',
            "external_reference" => "1234",
            'payer' => [
                'email' => "elainenogaroto@gmail.com",
                'first_name' => "Elaine",
                'last_name' => "Devólio",
                'identification' => [
                    'type' => 'CPF',
                    "number" => "21094091855"
                ],
                'address' => [
                    'zip_code' => "15505058",
                    'street_name' => "Rua Copacabana",
                    'street_number' => "3611",
                    'neighborhood' => "Estela Parque",
                    'city' => "Votuporanga",
                    'federal_unit' => "SP"
                ]
            ]
        ];

        try {
            $request = $this->client->request('POST', $this->url, ['body' => json_encode($payload)]);
            return json_decode($request->getBody());
        } catch (ClientException $ex) {
            return json_decode($ex->getResponse()->getBody(), true);
        }




    }
}
