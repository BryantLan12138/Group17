<?php

namespace App\Http\Controllers;

use App\Car;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin')->with('cars', Car::all())->with('users', User::all());
    }

    public function cars_management(){
        
        return view('cars_management')->with('cars', Car::all());
    }

    public function users_management(){
        
        return view('users_management')->with('users', User::all());
    }

    public function orders_management(){

        //update to orders when created order table
        return view('cars_management')->with('cars', Car::all());
    }

    public function cars_update($carId){
        return view('cars_update')->with('cars', Car::find($carId));
    }

    public function add_car(){
        return view('add_car');
    }

    public function car_store(Request $request){
        $newcar = new Car();
        $dbcar= DB::table('cars');
      //insert Marker: Car Park No.1 to No.10
      if($dbcar -> where('licenseplate','=',$request ->input('licenseplate')) -> count() > 0){
          echo "Car licenseplate already exist!";
        }else{
        $newcar->licenseplate = $request ->input('licenseplate');
        $newcar->make = $request ->input('make');
        $newcar->model = $request ->input('model');
        $newcar->address = $request ->input('address');
        //store image
        $file = $request -> file('image');
        $extension = $file -> getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('image/',$filename);
        $newcar->image = $filename; 

        $newcar -> save();
        }
        return view('add_car')->with('newcar',$newcar);

    }


    
    
}
