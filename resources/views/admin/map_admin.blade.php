
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
var lineSymbol1 = {
        path: "M237.7,327.45H237l-44.44,21.14-9-40.85,61.64-28.67h45.15V512H237.7Z",
        anchor:new google.maps.Point(237.7,327.45),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
};
var lineSymbol2 = {
        path: "M367.07,512V479l30.1-27.24c50.89-45.51,75.62-71.67,76.33-98.91,0-19-11.47-34-38.35-34-20.07,0-37.63,10-49.81,19.35l-15.41-39.06c17.56-13.26,44.8-24,76.33-24,52.68,0,81.71,30.82,81.71,73.11,0,39.06-28.31,70.24-62,100.34l-21.5,17.92v.72h87.8V512Z",
        anchor:new google.maps.Point(367.07,512),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
var lineSymbol3 = {
    path: "M575.63,458.61c9.68,5,31.89,14.33,54.11,14.33,28.31,0,42.65-13.62,42.65-31.18,0-22.94-22.94-33.33-46.95-33.33H603.22V369.38h21.14c18.28-.36,41.57-7.17,41.57-26.88,0-14-11.47-24.37-34.4-24.37-19,0-39.06,8.24-48.74,14l-11.11-39.42c14-9,41.93-17.56,72-17.56,49.81,0,77.41,26.16,77.41,58.06,0,24.73-14,44.08-42.65,54.11V388c28,5,50.53,26.16,50.53,56.62,0,41.21-36.2,71.31-95.33,71.31-30.1,0-55.55-7.88-69.17-16.48Z",
    anchor:new google.maps.Point(575.63,458.61),
    strokeColor: '#F00',
    fillColor: 'red',
    fillOpacity: 1,
    scale: 0.1
};
var lineSymbol4 = {
        path: "M861.24,512V456.46H758V421l88.16-141.91h66.66V415.61h28v40.85h-28V512Zm0-96.4V364c0-14,.72-28.31,1.79-43.36H861.6C854.08,335.69,848,349.31,840.1,364l-31.18,50.89v.72Z",
        anchor:new google.maps.Point(861.24,512),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol5 = {
        path: "M1119.26,323.87H1029l-5,35.84A100.94,100.94,0,0,1,1039,359c22.22,0,44.8,5,61.28,16.84,17.56,11.83,28.31,31.18,28.31,58.41,0,43.36-37.27,81.71-100,81.71-28.31,0-52-6.45-64.86-13.26l9.68-40.85c10.39,5,31.54,11.47,52.68,11.47,22.58,0,46.59-10.75,46.59-35.48,0-24-19-38.7-65.58-38.7a201.15,201.15,0,0,0-31.54,2.15L991,279.07h128.3Z",
        anchor:new google.maps.Point(1119.26,323.87),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol6 = {
        path: "M316.9,747.81c-6.09-.36-12.54,0-21.14.72-48.38,3.94-69.88,28.67-76,55.91h1.08c11.47-11.83,27.59-18.63,49.46-18.63,39.06,0,72,27.59,72,76,0,46.23-35.48,84.22-86,84.22-62,0-92.46-46.23-92.46-101.78,0-43.72,16.13-80.27,41.21-103.57,23.29-21.14,53.4-32.61,90-34.4a155.64,155.64,0,0,1,21.86-.36ZM287.16,864.64c0-21.5-11.47-40.14-34.76-40.14a35.53,35.53,0,0,0-32.25,20.79c-1.43,2.87-2.15,7.17-2.15,13.62,1.07,24.73,12.9,46.95,37.63,46.95C275,905.85,287.16,888.29,287.16,864.64Z",
        anchor:new google.maps.Point(316.9,747.81),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol7 = {
        path: "M534.07,709.1v34.4L438,942h-57.7l96-187.43v-.72H369.57V709.1Z",
        anchor:new google.maps.Point(534.07,709.1),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol8 = {
        path: "M562.37,881.12c0-28,16.13-47.3,41.57-58.41v-1.07c-22.58-11.47-33.69-30.46-33.69-50.89,0-39.42,35.48-65.58,82.07-65.58,54.47,0,77,31.54,77,59.85,0,20.07-10.75,39.78-33.69,51.25v1.08c22.58,8.6,42.65,28,42.65,58.06,0,42.29-35.48,70.6-89.59,70.6C589.61,946,562.37,912.66,562.37,881.12Zm120.41-1.79c0-20.43-15.05-32.61-36.55-38.34-17.92,5-28.31,17.92-28.31,34.76-.36,16.84,12.54,32.61,33,32.61C670.24,908.36,682.78,895.81,682.78,879.33ZM621.5,769c0,15.77,14.33,25.8,33,31.54,12.54-3.58,23.65-15.05,23.65-29.74,0-14.33-8.24-28.67-28.31-28.67C631.18,742.07,621.5,754.26,621.5,769Z",
        anchor:new google.maps.Point(562.37,881.12),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol9 = {
        path: "M782,902.62c6.81.72,12.9.72,23.65,0,16.49-1.07,33.33-5.73,45.87-14.33a72.41,72.41,0,0,0,29.39-43l-1.08-.36c-10.39,10.75-25.44,16.84-46.59,16.84-39.42,0-72.75-27.59-72.75-72.75,0-45.51,36.55-83.86,87.8-83.86,59.85,0,88.16,45.87,88.16,100.34,0,48.38-15.41,83.86-40.85,107.15-22.22,20.07-52.68,31.18-88.87,32.61a188,188,0,0,1-24.73,0Zm33-116.83c0,20.07,10.75,37.27,33,37.27,14.69,0,25.09-7.17,30.1-15.41,1.79-3.23,2.87-6.81,2.87-13.62,0-24.73-9.32-49.1-34-49.1C828.27,744.94,814.66,761.43,815,785.79Z",
        anchor:new google.maps.Point(782,902.62),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol10 = {
        path: "M1135.75,824.5c0,72-29,121.49-88.52,121.49-60.21,0-86.72-54.11-87.08-120.05,0-67.37,28.67-120.77,88.88-120.77C1111.38,705.16,1135.75,760.71,1135.75,824.5ZM1015,825.93c-.36,53.4,12.54,78.84,33.69,78.84s32.61-26.52,32.61-79.56c0-51.6-11.11-78.84-33-78.84C1028.24,746.37,1014.62,771.82,1015,825.93Z",
        anchor:new google.maps.Point(1135.75,824.5),
        strokeColor: '#F00',
        fillColor: 'red',
        fillOpacity: 1,
        scale: 0.1
    };
var lineSymbol11 = {
        path: "M237.7,327.45H237l-44.44,21.14-9-40.85,61.64-28.67h45.15V512H237.7Z",
        anchor:new google.maps.Point(237.7,327.45),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
};
var lineSymbol12 = {
        path: "M367.07,512V479l30.1-27.24c50.89-45.51,75.62-71.67,76.33-98.91,0-19-11.47-34-38.35-34-20.07,0-37.63,10-49.81,19.35l-15.41-39.06c17.56-13.26,44.8-24,76.33-24,52.68,0,81.71,30.82,81.71,73.11,0,39.06-28.31,70.24-62,100.34l-21.5,17.92v.72h87.8V512Z",
        anchor:new google.maps.Point(367.07,512),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
var lineSymbol13 = {
    path: "M575.63,458.61c9.68,5,31.89,14.33,54.11,14.33,28.31,0,42.65-13.62,42.65-31.18,0-22.94-22.94-33.33-46.95-33.33H603.22V369.38h21.14c18.28-.36,41.57-7.17,41.57-26.88,0-14-11.47-24.37-34.4-24.37-19,0-39.06,8.24-48.74,14l-11.11-39.42c14-9,41.93-17.56,72-17.56,49.81,0,77.41,26.16,77.41,58.06,0,24.73-14,44.08-42.65,54.11V388c28,5,50.53,26.16,50.53,56.62,0,41.21-36.2,71.31-95.33,71.31-30.1,0-55.55-7.88-69.17-16.48Z",
    anchor:new google.maps.Point(575.63,458.61),
    strokeColor: '#F00',
    fillColor: 'orange',
    fillOpacity: 1,
    scale: 0.1
};
var lineSymbol14 = {
        path: "M861.24,512V456.46H758V421l88.16-141.91h66.66V415.61h28v40.85h-28V512Zm0-96.4V364c0-14,.72-28.31,1.79-43.36H861.6C854.08,335.69,848,349.31,840.1,364l-31.18,50.89v.72Z",
        anchor:new google.maps.Point(861.24,512),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol15 = {
        path: "M1119.26,323.87H1029l-5,35.84A100.94,100.94,0,0,1,1039,359c22.22,0,44.8,5,61.28,16.84,17.56,11.83,28.31,31.18,28.31,58.41,0,43.36-37.27,81.71-100,81.71-28.31,0-52-6.45-64.86-13.26l9.68-40.85c10.39,5,31.54,11.47,52.68,11.47,22.58,0,46.59-10.75,46.59-35.48,0-24-19-38.7-65.58-38.7a201.15,201.15,0,0,0-31.54,2.15L991,279.07h128.3Z",
        anchor:new google.maps.Point(1119.26,323.87),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol16 = {
        path: "M316.9,747.81c-6.09-.36-12.54,0-21.14.72-48.38,3.94-69.88,28.67-76,55.91h1.08c11.47-11.83,27.59-18.63,49.46-18.63,39.06,0,72,27.59,72,76,0,46.23-35.48,84.22-86,84.22-62,0-92.46-46.23-92.46-101.78,0-43.72,16.13-80.27,41.21-103.57,23.29-21.14,53.4-32.61,90-34.4a155.64,155.64,0,0,1,21.86-.36ZM287.16,864.64c0-21.5-11.47-40.14-34.76-40.14a35.53,35.53,0,0,0-32.25,20.79c-1.43,2.87-2.15,7.17-2.15,13.62,1.07,24.73,12.9,46.95,37.63,46.95C275,905.85,287.16,888.29,287.16,864.64Z",
        anchor:new google.maps.Point(316.9,747.81),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol17 = {
        path: "M534.07,709.1v34.4L438,942h-57.7l96-187.43v-.72H369.57V709.1Z",
        anchor:new google.maps.Point(534.07,709.1),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol18 = {
        path: "M562.37,881.12c0-28,16.13-47.3,41.57-58.41v-1.07c-22.58-11.47-33.69-30.46-33.69-50.89,0-39.42,35.48-65.58,82.07-65.58,54.47,0,77,31.54,77,59.85,0,20.07-10.75,39.78-33.69,51.25v1.08c22.58,8.6,42.65,28,42.65,58.06,0,42.29-35.48,70.6-89.59,70.6C589.61,946,562.37,912.66,562.37,881.12Zm120.41-1.79c0-20.43-15.05-32.61-36.55-38.34-17.92,5-28.31,17.92-28.31,34.76-.36,16.84,12.54,32.61,33,32.61C670.24,908.36,682.78,895.81,682.78,879.33ZM621.5,769c0,15.77,14.33,25.8,33,31.54,12.54-3.58,23.65-15.05,23.65-29.74,0-14.33-8.24-28.67-28.31-28.67C631.18,742.07,621.5,754.26,621.5,769Z",
        anchor:new google.maps.Point(562.37,881.12),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol19 = {
        path: "M782,902.62c6.81.72,12.9.72,23.65,0,16.49-1.07,33.33-5.73,45.87-14.33a72.41,72.41,0,0,0,29.39-43l-1.08-.36c-10.39,10.75-25.44,16.84-46.59,16.84-39.42,0-72.75-27.59-72.75-72.75,0-45.51,36.55-83.86,87.8-83.86,59.85,0,88.16,45.87,88.16,100.34,0,48.38-15.41,83.86-40.85,107.15-22.22,20.07-52.68,31.18-88.87,32.61a188,188,0,0,1-24.73,0Zm33-116.83c0,20.07,10.75,37.27,33,37.27,14.69,0,25.09-7.17,30.1-15.41,1.79-3.23,2.87-6.81,2.87-13.62,0-24.73-9.32-49.1-34-49.1C828.27,744.94,814.66,761.43,815,785.79Z",
        anchor:new google.maps.Point(782,902.62),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbol20 = {
        path: "M1135.75,824.5c0,72-29,121.49-88.52,121.49-60.21,0-86.72-54.11-87.08-120.05,0-67.37,28.67-120.77,88.88-120.77C1111.38,705.16,1135.75,760.71,1135.75,824.5ZM1015,825.93c-.36,53.4,12.54,78.84,33.69,78.84s32.61-26.52,32.61-79.56c0-51.6-11.11-78.84-33-78.84C1028.24,746.37,1014.62,771.82,1015,825.93Z",
        anchor:new google.maps.Point(1135.75,824.5),
        strokeColor: '#F00',
        fillColor: 'orange',
        fillOpacity: 1,
        scale: 0.1
    };
    var lineSymbols = [lineSymbol11,lineSymbol12,lineSymbol13,lineSymbol14,lineSymbol15,lineSymbol16,lineSymbol17,lineSymbol18,lineSymbol19,lineSymbol20];
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
        icon: lineSymbols[i],
        
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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

    line = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol1,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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

    
    line1 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol2,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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
    

    line2 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol3,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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
    

    line3 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol4,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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


    line4 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol5,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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


    line5 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol6,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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


    line6 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol7,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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


    line7 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol8,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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


    line8 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol9,
            fixedRotation:true,
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
        for(i=0; i<50;i++)
        {
            rdm = getRandom(-10,10)/3000;
            rdm2 = getRandom(-10,10)/3000;
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


    line9 = new google.maps.Polyline({
        path: lineCoordinates,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 0,
        icons: [{
            icon: lineSymbol10,
            fixedRotation:true,
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
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
        
    }, 50);
}
// google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
<title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    


    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    html, body {
            background-color: #fff;
            color:black; 
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            
        }
        #map{
            margin: auto;
            position: relative;
            top:10px;
            left:0%;
            width: 90%;
        }
        .title {
            font-size: 84px;
            text-align: center;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        #login-icon{
            margin:auto;
            position: relative;
            top: 15%;
            left: 15%;
        }

        #return{
            margin:0%;
            position: relative;
            top: 15%;
            right: -100%
        }
    </style>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            
            <a class="navbar-brand" href="{{ url('/') }}">
               <img src="/image/logo.jpg" width="50" height="30" class="d-inline-block" alt=""> Carabc
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                {{-- <ul class="navbar-nav mr-auto smooth-scroll">
                    <a class="nav-link" href="{{ url('/about')}}">
                        About us
                    </a>
                </ul> --}}

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto"> 
                    <!-- Social Icon  -->
                    
                    <!-- Authentication Links -->
                    <li>                           
                        <svg class="bi bi-people-circle" id="login-icon" width="15px" height="15px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                            <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                          </svg>
                    </li>
                        
                            
                            <a id="navbarDropdown" class="nav-link" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <a href="/admin" id="return" class="nav-link">Return</a>
                            

                           
                               


                           
                        
                    
                
                    
                    
                </ul>
            </div>
        </div>
    </nav>
    </div>
<body>
    <div id='map'></div>
    {{ csrf_field() }}
</body>
</html>