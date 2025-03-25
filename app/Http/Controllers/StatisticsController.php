<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $salesStats = [
            'total_sales' => $this->getTotalSales(),
            'popular_plants' => $this->getPopularPlants(),
            'sales_by_category' => $this->getSalesByCategory(),
        ];

        return response()->json($salesStats);
    }

    private function getTotalSales()
    {
        return DB::table('orders')
            ->where('status', '!=', 'cancelled')
            ->select(
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_price) as total_revenue'),
                DB::raw('AVG(total_price) as average_order_value')
            )
            ->first();
    }

    private function getPopularPlants()
    {
        return DB::table('orders')
            ->join('plants', 'orders.plant_id', '=', 'plants.id')
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'plants.id',
                'plants.name',
                'plants.price',
                DB::raw('COUNT(*) as times_ordered'),
                DB::raw('SUM(orders.quantity) as total_quantity'),
                DB::raw('SUM(orders.total_price) as total_revenue')
            )
            ->groupBy('plants.id', 'plants.name', 'plants.price')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();
    }

    private function getSalesByCategory()
    {
        return DB::table('orders')
            ->join('plants', 'orders.plant_id', '=', 'plants.id')
            ->join('categories', 'plants.category_id', '=', 'categories.id')
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'categories.id',
                'categories.name',
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('SUM(orders.quantity) as total_items'),
                DB::raw('SUM(orders.total_price) as total_revenue')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_revenue', direction: 'desc')
            ->get();
    }

}