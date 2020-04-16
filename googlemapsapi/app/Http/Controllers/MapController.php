<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;
use \App\Car;

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

        $config['directions'] = true;
        $config['directionsDraggable'] = true;
        $config['directionsStart'] = 'Queens Domain, 12 Queens Rd, Melbourne,au';
        $config['directionsEnd'] = 'Metro Hobbies, Bourke Street, Melbourne, au';
        $config['directionsDivID'] =  'directionsDiv';

        $gmap = new GMaps();
        $gmap->initialize($config);

        //show carpark markers on map,  retrive data from carpark table in database
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

        return view('map', compact('map'))->with('cars', Car::all());
    }
    // public function showMap(){
    //     return view('map'); 
    // }
}
