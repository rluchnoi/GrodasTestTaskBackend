<?php

namespace App\Http\Controllers;

use App\Http\Services\Payment\Interfaces\PaymentServiceInterface;
use App\Http\Services\Payment\PaymentDTO;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Order Controller
 */
class OrderController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(
        private PaymentServiceInterface $paymentServiceInterface
    ) {}

    /**
     * Purchase an order
     */
    public function purchase(Order $order, Request $request): Response
    {
        $cardNumber = $request->get('cardNumber');
        $cardExpirationDate = $request->get('cardExpirationDate');
        $cardCVV = $request->get('cardCVV');

        $paymentDTO = new PaymentDTO($cardNumber, $cardExpirationDate, $cardCVV, $order);
        $response = $this->paymentServiceInterface->purchase($paymentDTO);

        return $response;
    }

    /**
     * Cancel an order
     */
    public function cancel(Order $order): Response
    {
        $order->delete();

        return response([
            'success' => true
        ]);
    }
}
