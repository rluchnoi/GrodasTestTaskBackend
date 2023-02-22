<?php

namespace App\Http\Services\Payment\Traits;

use App\Models\Order;
use Illuminate\Http\Response;

/**
 * Payment trait for shared payment functionality
 */
trait PaymentTrait
{
    /**
     * Process an order after it was purchased
     */
    public function processOrder(Order $order): Response
    {
        $order->status = Order::STATUS_CLOSED;
        $order->save();

        return response([
            'success' => true
        ]);
    }
}
