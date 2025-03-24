<?php

namespace App\Repositories\Interface;

interface OrderRepositoryInterface
{
    public function createOrder(array $orderDetails);
    public function getUserOrders($userId);
    public function getOrderById($orderId);
    public function getOrdersByStatus($status);
}