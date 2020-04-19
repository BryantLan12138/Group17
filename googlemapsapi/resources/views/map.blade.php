@extends('layouts.app')
@section('content')
<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        }

        /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        }
</Script>
    <div class="map">
        {!! $map['js'] !!}
        {!! $map['html'] !!}
    </div>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">About</a>
        <ul>
            @foreach($cars as $cars)
            <li>
                {{$cars->id}}{{$cars->licenseplate}}
            </li>
            @endforeach
        </ul>
        <div id="panel">
            <b>Destination: </b>
            <select id="Destination">
                <option>Select Your Car Park</option>
                <option value="Metro Hobbies, Bourke Street, Melbourne, au">CarPark1</option>
                <option value="Queens Domain, 12 Queens Rd, Melbourne,au">CarPark2</option>
                <option value="Hearns Hobbies, Melbourne, au">CarPark3</option>
                <option value="Minotaur, Elizabeth Street, Melbourne, au">CarPark4</option>
            </select>
        </div>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()" style="float: left" >&#9776; Show Cars</button>
    </div>
<script>
    var my_latlng = null;
    navigator.geolocation.getCurrentPosition(function(pos) {
        my_latlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
        var marker_icon = {url: "http://maps.google.com/mapfiles/ms/micons/yellow.png"};

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
        document.getElementById('Destination').addEventListener('change', onChangeHandler);
        currentPos = pos.coords.latitude+","+pos.coords.longitude;
        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
                origin: currentPos,
                destination: document.getElementById('Destination').value,
                travelMode: google.maps.TravelMode.DRIVING
            }, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Request for getting direction is failed due to ' + status);
                }
            });
        }
    });

</script>
@endsection
