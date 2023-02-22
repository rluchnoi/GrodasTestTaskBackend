<?php

namespace App\Http\Repositories;

use App\Models\Order;

/**
 * Order Repository
 */
class OrderRepository
{
    /**
     * Get open order by user id
     */
    public function getOpenOrderByUserId(int $userId): Order|null
    {
        return Order::where('user_id', $userId)
            ->where('status', Order::STATUS_OPEN)
            ->first();
    }
}
