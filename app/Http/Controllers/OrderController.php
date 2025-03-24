<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plant_slug' => 'required|string|exists:plants,slug',
            'quantity' => 'required|integer|min:1'
        ]);

        $order = $this->orderService->createOrder(
            $validated['plant_slug'],
            $validated['quantity'],
            auth()->id()
        );

        return response()->json($order->load('plant'), 201);
    }

    public function index()
    {
        $orders = $this->orderService->getUserOrders(auth()->id());
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrder($id);
        return response()->json($order);
    }


    public function cancel($id)
    {
        $order = $this->orderService->getOrder($id);


        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Only pending orders can be cancelled'], 400);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json($order);
    }
}