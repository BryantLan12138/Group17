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

        $db = DB::table('reports');
        $report = $db->get()->where('user_id',Auth::user()->id);


        //return view('report')->with('reports', $report);
        return view('history')->with('reports', $report);

    }


}
