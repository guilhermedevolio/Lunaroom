<?php


namespace App\Contracts;


interface PaymentContract
{
    public function makePayment(array $payload);
    public function handleResponse($payment_method, $response);
    public function getSaleById(int $id);
    public function handleCallback(array $payload);
}
