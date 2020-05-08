<?php

namespace App\Http\Controllers;

use App\Car;
use App\Order;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;


class MapController extends Controller
{

    public function map()
    {
        $config['center'] = 'auto';
        $config['zoom'] = '13';
        $config['map_height'] = '500px';
        $config['map_width'] = '1000px';
        $config['scrollwheel'] = false;
        $config['geocodeCaching'] = true;
        

        $gmap = new GMaps();
        $gmap->initialize($config);


        //Add carpark marker on map,  fetch data from carpark table in database
        $dbcar= DB::table('cars');
        $data = $dbcar -> get();
        foreach($data as $key => $value){
            if($value -> status == "available"){
            $marker['position'] = $value -> address;
            $marker['infowindow_content'] = $value -> make." ".$value -> model."<br><img src=".asset('image/'.$value -> image).">"."<br> <a href='/car_details/".$value -> id." class='btn btn-dark'>Book</a>"; 
            $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
            $marker['draggable'] = FALSE;
            $marker['animation'] = 'DROP';
            $gmap->add_marker($marker);
            }
         }

        $map = $gmap->create_map();
        return view('map',compact('map'))->with('cars', Car::all());
    }


   
    

    public function showCars($carId)
    {   
        $config_new['center'] = 'Melbourne, au';
        $config_new['zoom'] = '13';
        $config_new['map_height'] = '300px';
        $config_new['map_width'] = '500px';
        $config_new['scrollwheel'] = false;
        $config_new['geocodeCaching'] = true;
        

        $gmap_new = new GMaps();
        $gmap_new->initialize($config_new);


        //Add carpark marker on map,  fetch data from carpark table in database
        $dbcar_new= DB::table('cars');
        $data_new = $dbcar_new -> get();
        foreach($data_new as $key => $value){
            if($value -> id == substr($_SERVER['REQUEST_URI'], -1)){
            $marker_new['position'] = $value -> address;
            $marker_new['infowindow_content'] = "Car no.".$value -> id.", ".$value -> make.", ".$value -> model.", ".$value -> licenseplate;
            $marker_new['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
            $marker_new['draggable'] = FALSE;
            $marker_new['animation'] = 'DROP';
            $gmap_new->add_marker($marker_new);
            }
         }

        $map_new = $gmap_new->create_map();

        $car_lock = Car::find($carId);
        if($car_lock->status == 'available'){
            $car_lock->status = 'locked';
            $car_lock ->save();
        }

 
        return view('car_details', compact('map_new'))->with('cars',Car::find($carId));
    }

    public function showRecipt($carId){

        return view('payment')->with('cars', Car::find($carId));
    } 
    

    //change car status if booked
    public function statusBooked(Request $request, $carId){
        $car = Car::find($carId);
        $car -> status = $request->input('status');

        $car ->save();

        $order = new Order();
        $order-> hour = 0;
        $order-> minute = 0;
        $order -> start_location = $car -> address;
        $order -> end_location = '';

        $order -> save();

        session(['order_id'=>$order->id]);

        
        
       
        //return view('car_details', compact('map_new2'))->with('cars',Car::find($carId));
        //return redirect('car_details')->with('cars',Car::find($carId));
        return redirect()->route('status_booked', [$car]);
    }

    public function statusAvailable(Request $request, $carId){
        $car = Car::find($carId);
        $car -> status = $request->input('status');
        
        $car ->save();

        $order = Order::find(session('order_id'));
        $order-> hour = $request ->input('hour');
        $order-> minute = $request ->input('minute');
        $order -> end_location = 'Mockup End_location';

        $order -> save();


        return redirect()->route('status_available', [$car]);
    }

    public function cancelBooking(Request $request, $carId){
        $car = Car::find($carId);
        $car -> status = $request->input('status');
        
        $car -> save();
        return redirect()->route('cancel_booking',[$car]);
        //return view('home');
    }

    public function cancelStatus(){
        return view('cancel');
    }
}
