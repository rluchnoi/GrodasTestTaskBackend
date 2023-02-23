<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrderRequest;
use App\Http\Services\Payment\Interfaces\PaymentServiceInterface;
use App\Http\Services\Payment\PaymentDTO;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
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
    public function purchase(Order $order, PurchaseOrderRequest $request): Response
    {
        if ($order->isClosed()) {
            return response([
                'error' => 'An order was already purchased'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $data               = $request->validated();
        $cardExpirationDate = $data['cardExpirationDate'];
        $cardNumber         = $data['cardNumber'];
        $cardCVV            = $data['cardCVV'];
        $paymentDTO         = new PaymentDTO($cardNumber, $cardExpirationDate, $cardCVV, $order);
        $response           = $this->paymentServiceInterface->purchase($paymentDTO);

        return $response;
    }

    /**
     * Cancel an order
     */
    public function cancel(Order $order): Response
    {
        if ($order->isClosed()) {
            return response([
                'error' => 'An order is already bought'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $order->delete();

        return response([
            'success' => true
        ]);
    }
}
