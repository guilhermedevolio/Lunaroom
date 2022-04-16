<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function viewCheckout()
    {
        return view('campus.payment.checkout');
    }

    public function teste()
    {
       dd( (new MercadoPagoService())->generatePixPaymentTest());
    }
}
