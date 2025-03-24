<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $orderDetails)
    {
        return Order::create($orderDetails);
    }

    public function getUserOrders($userId)
    {
        return Order::with('plant')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getOrderById($orderId)
    {
        return Order::with('plant')->findOrFail($orderId);
    }
}