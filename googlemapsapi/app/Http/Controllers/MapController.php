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
            $marker['position'] = $value -> address;
            $marker['infowindow_content'] = $value -> make." ".$value -> model."<br><img src=".asset('image/'.$value -> image).">"; 
            $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
            $marker['draggable'] = FALSE;
            $marker['animation'] = 'DROP';
            $gmap->add_marker($marker);
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
            $marker_new['position'] = $value -> address;
            $marker_new['infowindow_content'] = $value -> make;
            $marker_new['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
            $marker_new['draggable'] = FALSE;
            $marker_new['animation'] = 'DROP';
            $gmap_new->add_marker($marker_new);
         }

        $map_new = $gmap_new->create_map();
 
        return view('car_details', compact('map_new'))->with('cars',Car::find($carId));
    }

    public function showRecipt($carId){

        return view('payment')->with('cars', Car::find($carId));
    } 
}
