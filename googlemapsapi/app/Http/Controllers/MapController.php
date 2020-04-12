<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;
use \App\Car;
use \App\Carpark;

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

        //insert carpark  to database
        $dbcar = DB::table('cars');
        if ($dbcarpark->where('carpark', '=', 'Car Park 1')->count() > 0) {
            //echo 'Car Park No.1 already exist!';
            $result = false;
        } else {
            $result = $dbcarpark->insert([
                [
                    'carpark' => 'Car Park 1',
                    'address' => 'Metro Hobbies, Bourke Street, Melbourne, au',
                    'capacity' => 10,
                    'vacancy' => (10-$dbcar->where('carpark', '=', 'Car Park 1')->count()),
                ], 
                [
                    'carpark' => 'Car Park 2',
                    'address' => 'Queens Domain, 12 Queens Rd, Melbourne,au',
                    'capacity' => 10,
                    'vacancy' => (10-$dbcar->where('carpark', '=', 'Car Park 2')->count()),
                ],
                [
                    'carpark' => 'Car Park 3',
                    'address' => 'Hearns Hobbies, Melbourne, au',
                    'capacity' => 10,
                    'vacancy' => (10-$dbcar->where('carpark', '=', 'Car Park 3')->count()),
                ],
                [
                    'carpark' => 'Car Park 4',
                    'address' => 'Minotaur, Elizabeth Street, Melbourne, au',
                    'capacity' => 10,
                    'vacancy' => (10-$dbcar->where('carpark', '=', 'Car Park 4')->count()),
                ]


            ]);
        }
        //Insert cars to database
        
        if ($dbcar->where('licenseplate', '=', 'ABC111')->count() > 0) {
            //echo 'Car already exist!';
            $result = false;
        } else {
            $result = $dbcar->insert([
                [
                    'licenseplate' => 'ABC111',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 1'
                ],
                [
                    'licenseplate' => 'ABC222',
                    'make' => 'maketest2',
                    'model' => 'modeltest2',
                    'carpark' => 'Car Park 2'
                ],
                [
                    'licenseplate' => 'ABC333',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 2'
                ],
                [
                    'licenseplate' => 'ABC444',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 2'
                ],
                [
                    'licenseplate' => 'ABC555',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 3'
                ],
                [
                    'licenseplate' => 'ABC666',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 3'
                ],
                [
                    'licenseplate' => 'ABC777',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 4'
                ],
                [
                    'licenseplate' => 'ABC888',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 5'
                ],
                [
                    'licenseplate' => 'ABC999',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 5'
                ],
                [
                    'licenseplate' => 'ABC000',
                    'make' => 'maketest1',
                    'model' => 'modeltest1',
                    'carpark' => 'Car Park 5'
                ]

            ]);
        }



        return view('map', compact('map'))->with('cars', Car::all());
    }
}
