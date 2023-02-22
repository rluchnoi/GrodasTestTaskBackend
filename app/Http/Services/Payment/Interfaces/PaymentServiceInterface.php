<?php

namespace App\Http\Services\Payment\Interfaces;

use App\Http\Services\Payment\PaymentDTO;
use Illuminate\Http\Response;

/**
 * Payment Service Interface
 */
interface PaymentServiceInterface 
{
    /**
     * Purchase an order
     */
    public function purchase(PaymentDTO $paymentDTO): Response;
}
