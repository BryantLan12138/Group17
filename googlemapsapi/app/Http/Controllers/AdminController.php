<?php

namespace App\Http\Controllers;

use App\Car;
use App\Carpark;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin')->with('cars', Car::all())->with('users', User::all())->with('carparks', Carpark::all());
    }
}
