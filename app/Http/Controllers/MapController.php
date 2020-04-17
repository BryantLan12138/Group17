<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

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


        $marker['position'] = 'Metro Hobbies, Bourke Street, Melbourne, au';
        $marker['infowindow_content'] = 'Car Park 1';
        $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';

        $gmap->add_marker($marker);

        $marker['position'] = 'Queens Domain, 12 Queens Rd, Melbourne,au';
        $marker['infowindow_content'] = 'Car Park 2';
        $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';
        $marker['draggable'] = TRUE;
        $marker['animation'] = 'DROP';

        $gmap->add_marker($marker);

        $marker['position'] = 'Hearns Hobbies, Melbourne, au';
        $marker['infowindow_content'] = 'Car Park 3';
        $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';

        $gmap->add_marker($marker);

        $marker['position'] = 'Minotaur, Elizabeth Street, Melbourne, au';
        $marker['infowindow_content'] = 'Car Park 4';
        $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal2/icon47.png';

        $gmap->add_marker($marker);

        $map = $gmap->create_map();
        return view('map',compact('map'));
    }
}
