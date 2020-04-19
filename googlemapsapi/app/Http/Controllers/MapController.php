<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function map()
    {
        $config['center'] = 'Melbourne, au';
        $config['zoom'] = '13';
        $config['map_height'] = '500px';
        $config['map_width'] = '1000px';
        $config['scrollwheel'] = false;
        $config['geocodeCaching'] = true;
        

        $gmap = new GMaps();
        $gmap->initialize($config);


        //Add carpark marker on map,  fetch data from carpark table in database
        $dbcarpark = DB::table('carparks');
        $data = $dbcarpark -> get();
        foreach($data as $key => $value){
            $marker['position'] = $value -> address;
            $marker['infowindow_content'] = $value -> carpark.' [Vacancy:'.$value -> vacancy.']';
            $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
            $marker['draggable'] = TRUE;
            $marker['animation'] = 'DROP';
            $gmap->add_marker($marker);
         }

        $map = $gmap->create_map();
        return view('map',compact('map'))->with('cars', Car::all());
    }

    public function showCars($carId)
    {
 
        return view('car_details')->with('cars',Car::find($carId));
    }
   
}
