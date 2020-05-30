
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0 }
    #map { height: 90%; width: 90% }
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCRtqgN4NPo8nBZvXdpPxTgdeoQHT_y8f4&libraries=geometry"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
var mlat=[];
var mlng=[];
var carstatus = []; 
$(document).ready(function(){

fetch_data();
fetch_data2();
function fetch_data()
{
 $.ajax({
  url:"/admin/map_admin/fetch_data",
  dataType:"json",
  success:function(data)
  {
   for(var count=0; count < data.length; count++)
   {
    carstatus.push(data[count].status);
    console.log(data[count].status);
   };}
//    ,   complete:function (data) {
//         var interval = setInterval(5000);
//             setTimeout(fetch_data, interval);
//     }
 });
}
function fetch_data2()
{
 $.ajax({
  url:"/admin/map_admin/fetch_data2",
  dataType:"json",
  success:function(data2)
  {
   for(var count=0; count < data2.length; count++)
   {
    mlat.push(data2[count].latitude)
    mlng.push(data2[count].longitude)
    
   }
   initialize();
  }
//    ,   complete:function (data) {
//         var interval = setInterval(1000);
//                     setTimeout(fetch_data, interval);
//             }
 });
}
});

var line;
var geocoder = new google.maps.Geocoder;
var map;
var pointDistances;
var failed = "failed";
function initialize() {
    var mapOptions = {
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(-37.8135303, 144.9660143)
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var markers = [];
    for (var i = 0; i < 10; i++) {
    
   if(carstatus[i]=="available"){
       console.log("ava");
    var pos = new google.maps.LatLng(mlat[i],mlng[i]);
    // console.log(pos);
    markers[i] = new google.maps.Marker({
        position: pos,
        map: map,
        id: i,
        icon: 'http://maps.google.com/mapfiles/kml/pal2/icon47.png'
    });
   }else if(carstatus[i]=="locked"){
    var pos = new google.maps.LatLng(mlat[i],mlng[i]);
    // console.log(pos);
    markers[i] = new google.maps.Marker({
        position: pos,
        map: map,
        id: i,
        icon: 'http://maps.google.com/mapfiles/kml/pal2/icon39.png'
    });

   }
}
function getRandom (n, m) {
            var num = Math.floor(Math.random() * (m - n + 1) + n)
            return num
        }
        for(var j=0;j<10;j++)
{
    if(carstatus[j]=="booked"){
        if(j==0){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();
        var address ='';
        

        // console.log(mmlat);
        // console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
                    mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 1;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log("12345");
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });

    animateCircle();
    }
    if(j==1){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();
        var id=2;
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
                    mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    // point distances from beginning in %
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#010'
    };
    
    line1 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });

    animateCircle1();
    
    }
    if(j==2){
        var id = 3;
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
    
                    mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                   
            geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    // point distances from beginning in %
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line2 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle2();
    
    }
    if(j==3){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();

        console.log(mmlat);
        console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
        mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 4;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    // point distances from beginning in %
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line3 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle3();
    
    }
    if(j==4){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();

        console.log(mmlat);
        console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
        mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 5;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line4 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle4();
    
    }
    if(j==5){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();

        console.log(mmlat);
        console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
        mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 6;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    // point distances from beginning in %
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line5 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle5();
    
    }
    if(j==6){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();

        console.log(mmlat);
        console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
        mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 7;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line6 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle6();
    
    }
    if(j==7){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();

        console.log(mmlat);
        console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
        mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 8;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line7 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle7();
    
    }
    if(j==8){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();

        console.log(mmlat);
        console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
        mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 9;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line8 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle8();
    
    }
    if(j==9){
        var mmlat = mlat[j];
        var mmlng = mlng[j];
        var lineCoordinates = new Array();

        console.log(mmlat);
        console.log(mmlng);
        for(i=0; i<40;i++)
        {
            rdm = getRandom(-10,10)/4000;
            rdm2 = getRandom(-10,10)/4000;
            mmlat = +mmlat + +rdm;
            mmlng = +mmlng + +rdm2;
            lineCoordinates.push(new google.maps.LatLng(mmlat, mmlng));
        }
        mmlat=mmlat.toFixed(7);
                    mmlng=mmlng.toFixed(7);
                    var id = 10;
                    geocodeLatLng(geocoder);
            function geocodeLatLng(geocoder) {
                var latlng = {lat: parseFloat(mmlat), lng: parseFloat(mmlng)};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        address = results[0].formatted_address;
                        console.log(results[0].formatted_address)
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('MapController.update_data') }}",
                    method:"POST",
                    data:{
                        mmlat:mmlat, 
                        mmlng:mmlng, 
                        address:address,
                        id:id, 
                        // _token: _token
                    },
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
                    }else{
                        console.log(failed);
                    }
            })}
    var sphericalLib = google.maps.geometry.spherical;

    pointDistances = [];
    var pointZero = lineCoordinates[0];
    var wholeDist = sphericalLib.computeDistanceBetween(
                        pointZero,
                        lineCoordinates[lineCoordinates.length - 1]);
    
    // for (var i = 0; i < lineCoordinates.length; i++) {
    //     pointDistances[i] = 200 * sphericalLib.computeDistanceBetween(
    //                                     lineCoordinates[i], pointZero) / wholeDist;
    //     console.log('pointDistances[' + i + ']: ' + pointDistances[i]);
    // }

    // define polyline
    var lineSymbol = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        strokeColor: '#393'
    };

    line9 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol,
            offset: '100%'
        }],
        map: map
    });
    animateCircle9();
    
    }
    }
}
}


var id;
function animateCircle() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line.get('icons');
        icons[0].offset = (offset) + '%';
        line.set('icons', icons);
        
        if (line.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line.set('icons', icons);
            window.clearInterval(id);
        }
        
    }, 30);
}
var id1;
function animateCircle1() {
    var count = 0;
    var offset;
    var sentiel = -1;

    id1 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line1.get('icons');
        icons[0].offset = (offset) + '%';
        line1.set('icons', icons);
        
        if (line1.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line1.set('icons', icons);
            window.clearInterval(id1);
        }
        
    }, 30);
}
var id2;
function animateCircle2() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id2 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line2.get('icons');
        icons[0].offset = (offset) + '%';
        line2.set('icons', icons);
        
        if (line2.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line2.set('icons', icons);
            window.clearInterval(id2);
        }
        
    }, 30);
}
var id3;
function animateCircle3() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id3 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line3.get('icons');
        icons[0].offset = (offset) + '%';
        line3.set('icons', icons);
        
        if (line3.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line3.set('icons', icons);
            window.clearInterval(id3);
        }
        
    }, 30);
}
var id4;
function animateCircle4() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id4 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line4.get('icons');
        icons[0].offset = (offset) + '%';
        line4.set('icons', icons);
        
        if (line4.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line4.set('icons', icons);
            window.clearInterval(id4);
        }
        
    }, 30);
}
var id5;
function animateCircle5() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id5 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line5.get('icons');
        icons[0].offset = (offset) + '%';
        line5.set('icons', icons);
        
        if (line5.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line5.set('icons', icons);
            window.clearInterval(id5);
        }
        
    }, 30);
}
var id6;
function animateCircle6() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id6 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line6.get('icons');
        icons[0].offset = (offset) + '%';
        line6.set('icons', icons);
        
        if (line6.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line6.set('icons', icons);
            window.clearInterval(id6);
        }
        
    }, 30);
}
var id7;
function animateCircle7() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id7 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line7.get('icons');
        icons[0].offset = (offset) + '%';
        line7.set('icons', icons);
        
        if (line7.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line7.set('icons', icons);
            window.clearInterval(id7);
        }
        
    }, 30);
}
var id8;
function animateCircle8() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id8 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line8.get('icons');
        icons[0].offset = (offset) + '%';
        line8.set('icons', icons);
        
        if (line8.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line8.set('icons', icons);
            window.clearInterval(id8);
        }
        
    }, 30);
}
var id9;
function animateCircle9() {
    var count = 0;
    var offset;
    var sentiel = -1;
    
    id9 = window.setInterval(function () {
        count = (count + 1) % 200;
        offset = count /2;
        var icons = line9.get('icons');
        icons[0].offset = (offset) + '%';
        line9.set('icons', icons);
        
        if (line9.get('icons')[0].offset == "99.5%") {
            icons[0].offset = '100%';
            line9.set('icons', icons);
            window.clearInterval(id9);
        }
        
    }, 30);
}
// google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
    <div id='map'></div>
    {{ csrf_field() }}
</body>
</html>