<?php

namespace App\Services;

use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\PlantRepositoryInterface;

class OrderService
{
    private $orderRepository;
    private $plantRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        PlantRepositoryInterface $plantRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->plantRepository = $plantRepository;
    }

    public function createOrder(string $plantSlug, int $quantity, int $userId)
    {
        $plant = $this->plantRepository->getPlantBySlug($plantSlug);
        $totalPrice = $plant->price * $quantity;

        return $this->orderRepository->createOrder([
            'user_id' => $userId,
            'plant_id' => $plant->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);
    }

    public function getUserOrders($userId)
    {
        return $this->orderRepository->getUserOrders($userId);
    }

    public function getOrder($orderId)
    {
        return $this->orderRepository->getOrderById($orderId);
    }
}