<?php

namespace App\Http\Repositories;

use App\Models\Order;

/**
 * Order Repository
 */
class OrderRepository
{
    /**
     * Get user roles
     */
    public function getOpenOrderByUserId(int $userId): Order|null
    {
        return Order::where('user_id', $userId)
            ->where('status', Order::STATUS_OPEN)
            ->first();
    }
}
