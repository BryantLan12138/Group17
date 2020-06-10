<?php

namespace App\Http\Controllers;

use App\Car;
use App\Order;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function bookingHistory()
    {
        //For generating booking history table list for user
        //Join two tables
        $reports = DB::table('reports')
            ->leftJoin('orders', 'reports.order_id', '=', 'orders.id')
            ->leftJoin('cars', 'reports.car_id', '=', 'cars.id')
            ->leftJoin('users', 'reports.user_id', '=', 'users.id')
            ->select('orders.hour','orders.id', 'orders.minute', 'orders.end_location', 'orders.created_at', 'orders.start_location', 'reports.id', 'reports.user_id', 'reports.car_id', 'reports.order_id', 'reports.firstname', 'reports.lastname', 'reports.mobile', 'reports.user_address', 'cars.id', 'cars.licenseplate', 'cars.unit_price','cars.make', 'cars.model', 'cars.address', 'cars.image', 'users.id', 'users.email', 'users.name')
            ->where('reports.user_id', '=', Auth::user()->id)->get();

        return view('history')->with('reports', $reports);
    }

    public function generateReport($orderId)
    {
        //For generating transaction details with user selected booking history
        //Join two tables
        $user_reports = DB::table('reports')
            ->leftJoin('orders', 'reports.order_id', '=', 'orders.id')
            ->leftJoin('cars', 'reports.car_id', '=', 'cars.id')
            ->leftJoin('users', 'reports.user_id', '=', 'users.id')
            ->select('orders.hour','orders.id', 'orders.minute', 'orders.end_location', 'orders.created_at', 'orders.start_location', 'reports.id', 'reports.user_id', 'reports.car_id', 'reports.order_id', 'reports.firstname', 'reports.lastname', 'reports.mobile', 'reports.user_address', 'cars.id', 'cars.licenseplate', 'cars.unit_price','cars.make', 'cars.model', 'cars.address', 'cars.image', 'users.id', 'users.email', 'users.name')
            ->where('reports.order_id', '=', $orderId)->get();

        return view('report.user_report')->with('reports', $user_reports);
    }
}
