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
    public function createReport(Request $request){
        $report = new Report();
        $report->order_id = $request ->input('order_id');
        $report->user_id = $request ->input('user_id');
        $report->car_id = $request ->input('car_id');
        $report->firstname = $request ->input('firstname');
        $report->lastname = $request ->input('lastname');
        $report->mobile = $request ->input('mobile');
        $report->address = $request ->input('address');
        
        $report -> save();
        
        return redirect()->route('user_report', [$report]);

    }

    public function generateReport(){

        // $reports = DB::table('reports');
        // $report = $reports->get()->where('user_id',Auth::user()->id);

        //Join two tables
        $reports = DB::table('reports') -> leftJoin('orders','reports.order_id','=','orders.id') ->where('reports.user_id','=',Auth::user()->id)-> get();
        
        return view('history')->with('reports', $reports);

    }


}
