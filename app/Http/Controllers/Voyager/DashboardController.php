<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

class DashboardController extends BaseVoyagerController
{
    public function statistics()
    { 
        // Generate an array of all month names for the last six months
        $months = [];
        $currentMonth = Carbon::now();
        for ($i = 5; $i >= 0; $i--) {
            $months[] = $currentMonth->copy()->subMonths($i)->format('F');
        }
        // Create a query to get data for those months
        $orders = DB::table('orders')
            ->select(
                DB::raw("SUM(Paid_amount) as sum_amount"),
                DB::raw("MONTHNAME(created_at) as month_name")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("month_name"))
            ->get();
        // Create a collection of the query results
        $ordersCollection = collect($orders);
        // Initialize an array to store the results with zero values for missing months
        $result = [];
        foreach ($months as $month) {
            $data = $ordersCollection->where('month_name', $month)->first();
            $result[$month] = $data ? $data->sum_amount : 0;
        }
        $labels = $months;
        $data = array_values($result);

        $allData = $this->getAllData();
        return view('vendor.voyager.statistics.index', compact('labels', 'data','allData'));
    }


    public function getAllData() 
    {
        $currentDate = Carbon::now();

        $todayOrders = Order::today()->count();
        $weeklyOrders = Order::thisWeek()->count();
        $monthlyOrders = Order::thisMonth()->count();
        $totalOrders = Order::count();

        $todayIncome = Order::whereDate('created_at', $currentDate)->sum('Paid_amount');
        $todayTax = Order::whereDate('created_at', $currentDate)->sum('Tax');
        $todayProfit = $todayIncome - $todayTax;

        $weeklyIncome = Order::whereBetween('created_at', [$currentDate->startOfWeek()->toDateString(), $currentDate->endOfWeek()->toDateString()])->sum('Paid_amount');
        $weeklyTax = Order::whereBetween('created_at', [$currentDate->startOfWeek()->toDateString(), $currentDate->endOfWeek()->toDateString()])->sum('Tax');
        $weeklyProfit = $weeklyIncome - $weeklyTax;

        $monthlyIncome = Order::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('Paid_amount');
        $monthlyTax = Order::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('Tax');
        $monthlyProfit = $monthlyIncome - $monthlyTax;

        $totalIncome = Order::sum('Paid_amount');
        $totalTax = Order::sum('Tax');
        $totalProfit = $totalIncome - $totalTax;

        $allData = [
            'todayIncome' =>$todayIncome,
            'weeklyIncome' =>$weeklyIncome,
            'monthlyIncome' =>$monthlyIncome,
            'totalIncome' =>$totalIncome,

            'todayProfit' =>$todayProfit,
            'weeklyProfit' =>$weeklyProfit,
            'monthlyProfit' =>$monthlyProfit,
            'totalProfit' =>$totalProfit,

            'todayOrders' =>$todayOrders,
            'weeklyOrders' =>$weeklyOrders,
            'monthlyOrders' =>$monthlyOrders,
            'totalOrders' =>$totalOrders,
        ];
        return $allData;
    }
}