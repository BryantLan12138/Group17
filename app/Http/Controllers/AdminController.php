<?php

namespace App\Http\Controllers;

use App\Car;
use App\Feedback;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin.admin')->with('cars', Car::all())->with('users', User::all());
    }
    //Admin can view all the cars and select one to update or delete
    public function cars_management(){
        
        return view('admin.cars_management')->with('cars', Car::all());
    }

    public function users_management(){
        
        return view('admin.users_management')->with('users', User::all());
    }

    public function orders_management(){

        //update to orders when created order table
        return view('admin.orders_management');
    }



    public function add_car(){
        return view('admin.add_car');
    }
    //Create new car with required input 
    public function car_store(Request $request){
        $this->validate($request,[
            'licenseplate' => 'required',
            'make' => 'required',
            'model' => 'required',
            'address' => 'required',
            'image' => 'required',
            'unit_price' => 'required',
        ]);
        $newcar = new Car();
        $newcar->licenseplate = $request ->input('licenseplate');
        $newcar->make = $request ->input('make');
        $newcar->model = $request ->input('model');
        $newcar->unit_price = $request ->input('unit_price');
        $newcar->address = $request ->input('address');
        //store image
        $file = $request -> file('image');
        $extension = $file -> getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('image/',$filename);
        $newcar->image = $filename; 

        $newcar -> save();
        return redirect('admin/cars_management')->with('success','Added successfully!');

    }

    public function car_edit($carId){
        return view('admin.car_edit')->with('cars', Car::find($carId));
    }
    //Update selected car with license plate and unit price, if no data is entered, the original data will be kept
    public function car_update(Request $request, $carId){
        $edit_car = Car::find($carId);
        $edit_car -> licenseplate = $request->input('licenseplate');
        $edit_car -> unit_price = $request->input('unit_price');

        $edit_car->save();

        return redirect('admin/cars_management')->with('success','Updated successfully!');

    }
    //Delete selected car from database
    public function car_delete($carId){
        $destroy_car = Car::find($carId);
        $destroy_car -> delete();
        return redirect('admin/cars_management')->with('success','Deleted successfully!');
    }
    //Admin view feedbacks sent from users, most recent feedback is displayed in top of the list
    public function feedback(){
        return view('admin.feedback')->with('feedbacks', Feedback::all()->sortByDesc('created_at'));
    }


    
    
}
