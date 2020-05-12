@foreach ($gmaps_geocache as $row)
<tr>
<table style="width:100%">
<td>{{ $row -> id}}</td>
<td></td>
<td> {{ $mlat[] = $row -> latitude}}</td>
<td>{{ $mlng[] = $row -> longitude}}</td>
<td></td>
<td></td>
</tr>
</table>
@endforeach 

@foreach ($cars as $row)
<tr>
<table style="width:100%">
<td>{{ $row -> id}}</td>
<td></td>
<td> {{ $carstatus[] = $row -> status}}</td>
<td></td>
<td></td>
</tr>
</table>
@endforeach 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0 }
    #map { height: 90%; width: 90% }
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCRtqgN4NPo8nBZvXdpPxTgdeoQHT_y8f4&libraries=geometry"></script>
    
<script type="text/javascript">
var line;

var map;
var pointDistances;

function initialize() {
    var mapOptions = {
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
    var markers = [];
    var mlat = <?php echo json_encode($mlat); ?>; 
    var mlng = <?php echo json_encode($mlng); ?>; 
    var carstatus = <?php echo json_encode($carstatus); ?>; 
    for (var i = 0; i < 10; i++) {
    console.log(carstatus[i]);
   if(carstatus[i]=="available"){
    var pos = new google.maps.LatLng(mlat[i],mlng[i]);
    console.log(pos);
    markers[i] = new google.maps.Marker({
        position: pos,
        map: map,
        id: i,
        icon: 'http://maps.google.com/mapfiles/kml/pal2/icon47.png'
    });
   }else if(carstatus[i]=="locked"){
    var pos = new google.maps.LatLng(mlat[i],mlng[i]);
    console.log(pos);
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
        console.log(mmlat);
    
    map.setCenter(lineCoordinates[0]);
    
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
function animateCircle3() {
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
function animateCircle4() {
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
function animateCircle5() {
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
function animateCircle6() {
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
function animateCircle7() {
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
function animateCircle8() {
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
function animateCircle9() {
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

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>

<body>
<form class="chat" id="message" action="#" method="post">
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <li>
        <div class="panel-footer">
            <div class="input-group">
                <input type="text" name="message" class="" placeholder="Type your message here..." />
                <span class="input-group-btn">
                    <button type="button" class=" btn-success btn-sm searchButton" id="save" >Send</button>
                </span>
            </div>
        </div>
    </li>
</form>
    <div id='map'></div>
    
</body>
</html>