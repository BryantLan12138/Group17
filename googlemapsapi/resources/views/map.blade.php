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

        });
    },
    function(error) {
            clearTimeout(location_timeout);
            geolocFail();
        });}else {
        // Fallback for no geolocation
        geolocFail();}
        }
        

        window.onload = function () {
        document.getElementById('find').click()
        };
</Script>
    <div class="map">
        {!! $map['js'] !!}
        {!! $map['html'] !!}
    </div>
    <div id="mySidebar" class="sidebar">
        <a  class="closebtn" onclick="closeNav()">&times;</a>
        <h1 class="text-center my-5">Car List</h1>
        <div class="card card-default">
            <div class="card card-body">
            <ul class="list-group">
                @foreach($cars as $cars)
                @if($cars -> status == "available")
                <li class="list-group-item">
                    <img src="{{ asset('image/'.$cars -> image)}}" width="100px" height="auto" alt="{{$cars -> image}}">
                       {{$cars->make}}{{$cars->model}}
                    <a href="/car_details/{{$cars->id}}" class="btn btn-dark ">Details</a>&nbsp;&nbsp;&nbsp;
                </li>
                @endif
                @endforeach
            </ul>
            </div>
        </div>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()" style="float: left" >&#9776; Show Cars</button>
        <button onclick="getLocation();" data-role="button" id="find" class="btn btn-secondary btn-sm" style="display: none">Find Your Location!</button>
    </div>
@endsection
