<?php

namespace App\Http\Controllers;

use App\Car;
use App\Order;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;
use App\Feedback;


class MapController extends Controller
{
    //Ajax functions for simulator
    //fetch data from car table
    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('cars')->orderBy('id')->get();
            echo json_encode($data);
        }
    }
    //fetch data from google maps location table
    function fetch_data2(Request $request)
    {
        if($request->ajax())
        {
            $data2 = DB::table('gmaps_geocache')->orderBy('id')->get();
            echo json_encode($data2);
        }
    }
    //update new locations to google maps table
    function update_data(Request $request)
    {
        if($request->ajax())
        {
            $updateData = [
                'latitude' =>  $request->mmlat,
                'longitude' =>  $request->mmlng,
                'address' =>  $request->address
            ];
            
            DB::table('gmaps_geocache')
                ->where('id', $request->id)
                ->update($updateData);
                
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }
    //map on the root page
    public function map()
    {   //define the size of the map
        $config['center'] = 'auto';
        $config['zoom'] = '13';
        $config['map_height'] = '500px';
        $config['map_width'] = '1000px';
        $config['scrollwheel'] = false;
        $config['geocodeCaching'] = true;
        
        //Generate map with fahan's package with defined setting
        $gmap = new GMaps();
        $gmap->initialize($config);
        

        //Add carpark marker on map,  fetch data from carpark table in database
        $dbcar= DB::table('cars');
        $data = $dbcar -> get();
        foreach($data as $key => $value){
            if($value -> status == "available"){
            $marker['position'] = $value -> address;
            $marker['infowindow_content'] = $value -> make." ".$value -> model."<br><img src=".asset('image/'.$value -> image).">"."<br> <a href='/car_details/".$value -> id."' class='btn btn-dark'>Book</a>"; 
            $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
            $marker['draggable'] = FALSE;
            $marker['animation'] = 'DROP';
            $gmap->add_marker($marker);
            }
         }

        $map = $gmap->create_map();
        return view('map',compact('map'))->with('cars', Car::all());
    }


   
    
    //map on car details page
    public function showCars($carId)
    {   
        $config_new['center'] = 'auto';
        $config_new['zoom'] = '13';
        $config_new['map_height'] = '300px';
        $config_new['map_width'] = '500px';
        $config_new['scrollwheel'] = false;
        $config_new['geocodeCaching'] = true;
        

        $gmap_new = new GMaps();
        $gmap_new->initialize($config_new);


        //fetch data from car table in database
        $dbcar_new= DB::table('cars');
        $dblocation= DB::table('gmaps_geocache');
        $data_new = $dbcar_new -> get();
        $data_location=$dblocation -> get();
        $url=$_SERVER['REQUEST_URI'];
        $idnumber=explode("/",$url);

        foreach($data_location as $key => $value){
            
            if($value -> id == $idnumber[2]){
            $marker_new['position'] = $value -> address;
            $marker_new['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
            $marker_new['draggable'] = FALSE;
            $marker_new['animation'] = 'DROP';
            $gmap_new->add_marker($marker_new);
            }
         }

        $map_new = $gmap_new->create_map();
        //show only the status == available 
        $car_lock = Car::find($carId);
        if($car_lock->status == 'available'){
            $car_lock->status = 'locked';
            $car_lock ->save();
        }

 
        return view('car_details', compact('map_new'))->with('cars',Car::find($carId));
        return back()->withInput();
    }

    public function showRecipt($carId){

        return view('payment')->with('cars', Car::find($carId));
    } 
    

    //change car status if booked
    public function statusBooked(Request $request, $carId){
        $car = Car::find($carId);
        $car -> status = $request->input('status');

        $car ->save();
        $geocache = DB::table('gmaps_geocache')->where('id', $carId)->first();
        $order = new Order();
        $order-> hour = 0;
        $order-> minute = 0;
        $order -> start_location = $geocache -> address;
        $order -> end_location = '';
        $order-> status = 'unpaid';
        $order -> save();

        session(['order_id'=>$order->id]);

        return redirect()->route('status_booked', [$car]);
    }
    //change status available after return
    public function statusAvailable(Request $request, $carId){
        $car = Car::find($carId);
        $car -> status = $request->input('status');
        
       
        $geocache = DB::table('gmaps_geocache')->where('id', $carId)->first();
        $order = Order::find(session('order_id'));
        $order-> hour = $request ->input('hour');
        $order-> minute = $request ->input('minute');
        $order -> end_location = $geocache -> address;
        $car -> address = $geocache -> address;
        $car ->save();
        $order-> status = 'unpaid';
        $order -> save();


        return redirect()->route('status_available', [$car]);
    }

    //change status to available if users cancel the booking
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

    //map for admin page
    public function map_admin()
    {
        //Add carpark marker on map,  fetch data from carpark table in database
        $admincar= DB::table('cars');
        $admindata = $admincar -> get();
        $adminstatus = DB::select('select * from cars');
        $gmaps_geocache = DB::select('select * from gmaps_geocache');
        return view('admin.map_admin')->with('cars', Car::all())->with('gmaps_geocache',$gmaps_geocache);
    }
    //Users are allowed to send feedbacks
    public function sendFeedback(Request $request){
        $feedback = new Feedback();
        $feedback->name = $request->input('name');
        $feedback->email = $request->input('email');
        $feedback->subject = $request->input('subject');
        $feedback->message = $request->input('message');

        $feedback->save();
        return redirect('feedback')->with('success','we have received your feedback :)');
    }
}
