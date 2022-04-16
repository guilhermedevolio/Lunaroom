<?php

namespace App\Repositories;

use App\Exceptions\Payment\InvalidPaymentMethodException;

class PaymentRepository
{
    public function executeTransaction(array $payload)
    {
        $this->validatePaymentMethod($payload['payment_method']);
    }

    private function validatePaymentMethod($method) {
        $valid_methods = ['ccr', 'pix'];

        if(!$valid_methods[$method]) {
            throw new InvalidPaymentMethodException("The method " . $method . "is invalid");
        }
    }
}
