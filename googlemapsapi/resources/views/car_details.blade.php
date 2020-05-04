@extends('layouts.app')
@section('content')

<script>
    //JS for locating user's current location
    function getLocation() {
        if (navigator.geolocation) {
            var location_timeout = setTimeout("geolocFail()", 10000);
            var my_latlng = null;
            navigator.geolocation.getCurrentPosition(function(pos) {
                    my_latlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
                    var marker_icon = {
                        url: "http://maps.google.com/mapfiles/ms/micons/yellow.png"
                    };
                    clearTimeout(location_timeout);
                    var markerOptions = {
                        map: map,
                        position: my_latlng,
                        draggable: true,
                        icon: marker_icon,
                        animation: google.maps.Animation.DROP
                    };
                    var my_mark = createMarker_map(markerOptions);
                    my_mark.id = my_mark;

                    my_mark.set("content", "Current Location");
                    console.log(pos);

                    google.maps.event.addListener(my_mark, "click", function(event) {
                        iw_map.setContent(this.get("content"));
                        iw_map.open(map, this);
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
                    currentPos = pos.coords.latitude + "," + pos.coords.longitude;
                    //  {{session('location')}}= currentPos;
                    function calculateAndDisplayRoute(directionsService, directionsDisplay, ID) {
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
                            });
                    }
                },
                function(error) {
                    clearTimeout(location_timeout);
                    geolocFail();
                });
        } else {
            // Fallback for no geolocation
            geolocFail();
        }
    }
    function clickmap(){

        google.maps.event.addListener(map, "click", function(event) {
            var result = [event.latLng.lat(), event.latLng.lng()];
            transition(result);

    condition = false;
                    });
                    var i = 0;
                    var deltaLat;
                    var deltaLng;

                    function transition(result){
                        i = 0;
                        deltaLat = (result[0] - position[0])/numDeltas;
                        deltaLng = (result[1] - position[1])/numDeltas;
                        console.log(deltaLat,deltaLng);
                    }
                }

    //15 minutes countdown function
    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
           
        
        timing = setInterval(function() {
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

   
    //stop countdown when click 'confirm' button
   
      

        @if($cars->status=='available')
        document.getElementById('find').click();
        @endif


        //start locating user's location without clicking any button

        // function pauseTimer(){
        //         clearInterval(timer)
        //     }   
   

    function stopTiming() {
        condition = true;
        clearInterval(timing);
    }

    

</script>

<body>
    <div class="container">
        <h1 class="text-center" my-5>
            Car No. &nbsp;&nbsp;{{$cars->id}}&nbsp;&nbsp;&nbsp; Licenseplate:&nbsp;&nbsp;{{$cars->licenseplate}}
        </h1>
        <div class="card card-default">
            <div class="card-header">
                Details
                <!-- only the page for available cars will show counter and confirm button -->
                
                @if($cars->status=='available')
                <div>Transaction closes in <span id="time">15:00</span> minutes!</div>
                <form method="POST" action="{{ route('status_booked',$cars->id) }}" enctype="multipart/form-data" class="float-right">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" class="form-control" value="booked">
                    <button onclick="stopTiming();" class="btn btn-dark btn-sm float-right" type="submit" name="submit">Confirm</button>                   
                </form>
                <script>
                     window.onload = function() {
                            
                            var fifteenMinutes = 60 * 15,
                                display = document.querySelector('#time');
                            
                                startTimer(fifteenMinutes, display);
                    
                        //display 15 minutes countdown timer
                        

                        //start locating user's location without clicking any button   
                        document.getElementById('find').click()
                    };
                    //To get rid of getting error from js console, move the js to here after hind html element with id 'time'
                </script>
                @endif
                <!-- only the page for booked cars will show return button -->
                @if($cars->status=='booked')
                <!-- <a href="/car_details/{{$cars->id}}/payment" class="btn btn-dark btn-sm" style="float: right">Return</a> -->
                <br>You have booked {{$cars->make}} {{$cars->model}} {{$cars->licenseplate}} successfully!
                <br>
                <br>Service Started:
                <div id="timer">00:00:00</div>
                
                <script>/* One second in reality is equivelent to 1000 seconds in development, for testing purpose */

                      var timerVar = setInterval(countTimer, 1);
                        var totalSeconds = 0;
                        function countTimer() {
                        ++totalSeconds;
                        var hour = Math.floor(totalSeconds /3600);
                        var minute = Math.floor((totalSeconds - hour*3600)/60);
                        var seconds = totalSeconds - (hour*3600 + minute*60);
                        if(hour < 10)
                            hour = "0"+hour;
                        if(minute < 10)
                            minute = "0"+minute;
                        if(seconds < 10)
                            seconds = "0"+seconds;
                        document.getElementById("timer").innerHTML = hour + ":" + minute + ":" + seconds;
                        // var duration = document.getElementById("timer").innerHTML;
                        // // console.log(duration)
                        // console.log(duration);
                        // document.getElementById('duration').value = duration;
                        document.getElementById("hour").value = hour;
                        document.getElementById('minute').value = minute;
                        // document.getElementById("hour").setAttribute("value", hour);
                        // document.getElementById("mimute").setAttribute("value", minute);

                        // $session('hour') = hour;
                        // $session('minute') = minute;
                        }
                        //use ajax to pass js variable to php 

                        // var url = {{$cars->id}};
                        // $(document).ready(function(){
                        //     $.ajaxSetup({
                        //         headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //         }
                        //         });
                        //     $.ajax({
                        //         type: "POST",
                        //         url: './' + url +'/payment',  // I also tried index.php directly
                        //         data: {
                        //         _token : $('meta[name="csrf-token"]').attr('content'), 
                        //         "duration": duration
                        //         },
                        //         success:(function(data){
                        //             alert(data);
                        //         })
                        //         // error: function() {
                        //         //     alert('Not OKay');
                        //         // } 
                        //     });
                        // });

                        
                   
                </script>
                
                <form method="POST" action="{{ route('status_available',$cars->id) }}" enctype="multipart/form-data" class="float-right">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" class="form-control" value="available">
                    <input type="hidden" name="hour" id="hour" class="form-control" value="">
                    <input type="hidden" name="minute" id="minute" class="form-control" value="">
                    <button class="btn btn-dark btn-sm float-right" type="submit" name="submit">Return</button>
                </form>
                @endif
                <button onclick="getLocation();" data-role="button" id="find" class="btn btn-secondary btn-sm" style="display: none">Find Your Location!</button>&nbsp;&nbsp;
                <button value="{{$cars->address}}" id="Destination" class="btn btn-info btn-sm" style="float: right">Direct Me!</button>
                </div>
            <div class="card card-body">
                {{$cars->make}}&nbsp;&nbsp;{{$cars->model}} &nbsp;
                <br>locate at:&nbsp;&nbsp; {{$cars->address}}
                <br>Price for the vehicle:{{$cars->unit_price}}($/hour)
                <img src="{{ asset('image/'.$cars -> image)}}" width="500px" height="auto" alt="{{$cars -> image}}">
            </div>

        <div class="map1">
            {!! $map_new['js'] !!}
            {!! $map_new['html'] !!}
        </div>
            <!-- <button id="confirm" onclick="stopTiming();" class="btn btn-dark btn-sm">Confirm</button> -->


    </div>
</body>

@endsection