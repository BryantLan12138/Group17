@extends('layouts.app')
@section('content')

<script>
      //JS for locating user's current location
      function getLocation(){
        if (navigator.geolocation) {
        var location_timeout = setTimeout("geolocFail()", 10000);
        var my_latlng = null;
        navigator.geolocation.getCurrentPosition(function(pos) {
        my_latlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
        var marker_icon = {url: "http://maps.google.com/mapfiles/ms/micons/yellow.png"};
            clearTimeout(location_timeout);
        var markerOptions = {
            map: map,
            position: my_latlng,
            draggable: true,
            icon: marker_icon,
            animation:  google.maps.Animation.DROP
        };
        my_mark = createMarker_map(markerOptions);
        my_mark.id = my_mark;

        my_mark.set("content", "Current Location");
        console.log(pos);

        google.maps.event.addListener(my_mark, "click", function(event) {
            iw_map.setContent(this.get("content"));
            iw_map.open(map, this);
            alert("You just clicked on Maker!!")

        });
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });
        directionsDisplay.setMap(map);

        var onChangeHandler = function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        };

        document.getElementById('Destination').addEventListener('click', onChangeHandler);
          currentPos = pos.coords.latitude+","+pos.coords.longitude;
          //  {{session('location')}}= currentPos;
    function calculateAndDisplayRoute(directionsService, directionsDisplay,ID) {
        directionsService.route({
            origin: currentPos,
            destination: document.getElementById('Destination').value,
            travelMode: google.maps.TravelMode.DRIVING
            },
    function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Request for getting direction is failed due to ' + status);
        }
    }); }
    },
    function(error) {
            clearTimeout(location_timeout);
            geolocFail();
        });}else {
        // Fallback for no geolocation
        geolocFail();}}


    //15 minutes countdown function
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
            }
        }, 1000);
    }

    window.onload = function () {
        var fifteenMinutes = 60 * 15,
            display = document.querySelector('#time');
        startTimer(fifteenMinutes, display);
        document.getElementById('find').click()
    };
</script>

<body>
    <div class="container">
        <h1 class="text-center" my-5>
        Car No. &nbsp;&nbsp;{{$cars->id}}&nbsp;&nbsp;&nbsp; Licenseplate:&nbsp;&nbsp;{{$cars->licenseplate}}
        </h1> 
            <div class="card card-default">
                <div class="card-header">
                    Details
                    <div>Transaction closes in <span id="time">15:00</span> minutes!</div>
                    <button onclick="getLocation();" data-role="button" id="find" class="btn btn-secondary btn-sm" style="display: none">Find Your Location!</button>&nbsp;&nbsp;
                <button value="{{$cars->address}}" id="Destination" class="btn btn-info btn-sm" style="float: right">Direct Me!</button> 
                </div>
            <div class="card card-body">
                {{$cars->make}}&nbsp;&nbsp;{{$cars->model}} &nbsp;
                <br>locate at:&nbsp;&nbsp; {{$cars->address}}
            <img src="{{ asset('image/'.$cars -> image)}}" width="500px" height="auto" alt="{{$cars -> image}}">
            </div>
            
            <div class="map1">
                {!! $map_new['js'] !!}
                {!! $map_new['html'] !!}
            </div>
            <a href="/car_details/{{$cars->id}}/payment" class="btn btn-dark btn-sm">Checkout</a>
    </div>
</body>

@endsection