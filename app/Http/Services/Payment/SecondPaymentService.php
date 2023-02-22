<?php

namespace App\Http\Services\Payment;

use App\Http\Services\Payment\Interfaces\PaymentServiceInterface;
use App\Http\Services\Payment\Traits\PaymentTrait;
use Illuminate\Http\Response;

/**
 * Second Payment Service
 */
class SecondPaymentService implements PaymentServiceInterface
{
    use PaymentTrait;

    /**
     * Purchase an order
     */
    public function purchase(PaymentDTO $paymentDTO): Response
    {
        // perform purchase using $paymentDTO

        $this->processOrder($paymentDTO->getOrder());

        return response([
            'success' => true
        ]);
    }
}
