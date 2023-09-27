<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Order;
use Carbon\Carbon;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

class OrdersController extends BaseVoyagerController
{
    protected $pagination = 10;
    protected $filters = ['today', 'yesterday', 'thisWeek', 'thisMonth', 'pastMonth', 'thisYear', 'pastYear', 'all'];
    protected $statuses = ['paid', 'in process', 'failed', 'refunded', 'canceled'];

    public function index() {
        return view('vendor.voyager.orders.index',[
            'orders' => $this->ordersList($this->statuses),
            'statuses' => $this->statuses
        ]);
    }

    public function ordersList($statuses)
    {
        $filterBy = request()->filterBy ?? 'today';

        #check if filterBy is alphanumeric
        // if (!ctype_alnum($filterBy)) {
        //     abort(404);
        // }

        if (in_array($filterBy, $this->filters)) {
            return $this->filterOrders($filterBy);
        }

        foreach ($statuses as $status) {
            if ($filterBy === $status) {
                return \App\Models\Order::where('status', $status)->orderBy('created_at', 'desc')->paginate($this->pagination);
            }
        }
        

        return \App\Models\Order::orderBy('created_at', 'desc')->paginate(2);
    }

    public function filterOrders($filterBy)
    {
        $currentDateTime = Carbon::now();
        $today = $currentDateTime->toDateString();
        #today orders
        if ($filterBy == 'today') {
            return Order::whereHas('meeting', function ($query) use ($today) {
                $query->whereDate('DateMeeting', $today);
            })->paginate($this->pagination);
        }
        #yesterday orders
        if ($filterBy == 'yesterday') {
            $yesterday = $currentDateTime->subDay()->toDateString();
            return Order::whereHas('meeting', function ($query) use ($yesterday) {
                $query->whereDate('DateMeeting', $yesterday);
            })->paginate($this->pagination);
        }
        #this week orders
        if ($filterBy == 'thisWeek') {
            $thisWeekStart = $currentDateTime->startOfWeek()->toDateString();
            $thisWeekEnd = $currentDateTime->endOfWeek()->toDateString();
            return Order::whereHas('meeting', function ($query) use ($thisWeekStart, $thisWeekEnd) {
                $query->whereBetween('DateMeeting', [$thisWeekStart, $thisWeekEnd]);
            })->paginate($this->pagination);
        }
        #this month orders
        if ($filterBy == 'thisMonth') {
            $thisMonthStart = $currentDateTime->startOfMonth()->toDateString();
            $thisMonthEnd = $currentDateTime->endOfMonth()->toDateString();
            return Order::whereHas('meeting', function ($query) use ($thisMonthStart, $thisMonthEnd) {
                $query->whereBetween('DateMeeting', [$thisMonthStart, $thisMonthEnd]);
            })->paginate($this->pagination);
        }
        #past month orders
        if ($filterBy == 'pastMonth') {
            $pastMonthStart = Carbon::now()->subMonth()->startOfMonth();
            $pastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
            // Retrieve orders for the past month
            return Order::whereHas('meeting', function ($query) use ($pastMonthStart, $pastMonthEnd) {
                $query->whereBetween('DateMeeting', [$pastMonthStart->toDateString(), $pastMonthEnd->toDateString()]);
            })->paginate($this->pagination);
        }
        #this year orders
        if ($filterBy == 'thisYear') {
            $thisYearStart = $currentDateTime->startOfYear()->toDateString();
            $thisYearEnd = $currentDateTime->endOfYear()->toDateString();
            return Order::whereHas('meeting', function ($query) use ($thisYearStart, $thisYearEnd) {
                $query->whereBetween('DateMeeting', [$thisYearStart, $thisYearEnd]);
            })->paginate($this->pagination);
        }
        #past year orders
        if ($filterBy == 'pastYear') {
            $pastYearStart = $currentDateTime->subYear()->startOfYear()->toDateString();
            $pastYearEnd = $currentDateTime->subYear()->endOfYear()->toDateString();
            return Order::whereHas('meeting', function ($query) use ($pastYearStart, $pastYearEnd) {
                $query->whereBetween('DateMeeting', [$pastYearStart, $pastYearEnd]);
            })->paginate($this->pagination);
        }
        #all orders
        if ($filterBy == 'all') {
            return \App\Models\Order::orderBy('created_at', 'desc')->paginate($this->pagination);
        }
    }


    public function orderDetails($order)
    {
        $order = \App\Models\Order::with([
            'meeting',
            'client',
        ])->where('id', $order)->firstOrFail();
        return view('vendor.voyager.orders.order-details', compact('order'));
    }

}