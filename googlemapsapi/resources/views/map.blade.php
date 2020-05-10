@extends('layouts.app')
@section('content')
<script>
    // javascript for sidebar
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
    //javascript for validating users input 
    function validateForm() {
        var name = document.getElementById('name').value;
        if (name == "") {
            document.querySelector('.status').innerHTML = "Name cannot be empty";
            return false;
        }
        var email = document.getElementById('email').value;
        if (email == "") {
            document.querySelector('.status').innerHTML = "Email cannot be empty";
            return false;
        } else {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test(email)) {
                document.querySelector('.status').innerHTML = "Email format invalid";
                return false;
            }
        }
        var subject = document.getElementById('subject').value;
        if (subject == "") {
            document.querySelector('.status').innerHTML = "Subject cannot be empty";
            return false;
        }
        var message = document.getElementById('message').value;
        if (message == "") {
            document.querySelector('.status').innerHTML = "Message cannot be empty";
            return false;
        }
        document.querySelector('.status').innerHTML = "Sending...";
    }
    //javascript for locating user's current location
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
                });
        } else {
            // Fallback for no geolocation
            geolocFail();
        }
    }


    window.onload = function() {
        document.getElementById('find').click()
    };
</Script>

<!--Main layout-->
<main class="mt-5">
    <div class="container">

        <!--Section: Best Features-->
        <section id="best-features" class="text-center">

            <!-- Heading -->
            <h2 class="mb-5 font-weight-bold">Best Features</h2>

            <!--Grid row-->
            <div class="row d-flex justify-content-center mb-4">

                <!--Grid column-->
                <div class="col-md-8">

                    <!-- Description -->
                    <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi voluptate
                        hic
                        provident nulla repellat
                        facere esse molestiae ipsa labore porro minima quam quaerat rem, natus repudiandae debitis
                        est
                        sit pariatur.</p>

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-4 mb-5">
                    <i class="fa fa-camera-retro fa-4x orange-text"></i>
                    <h4 class="my-4 font-weight-bold">Experience</h4>
                    <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                        maiores nam,
                        aperiam minima
                        assumenda deleniti hic.</p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 mb-1">
                    <i class="fa fa-heart fa-4x orange-text"></i>
                    <h4 class="my-4 font-weight-bold">Happiness</h4>
                    <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                        maiores nam,
                        aperiam minima
                        assumenda deleniti hic.</p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 mb-1">
                    <i class="fa fa-bicycle fa-4x orange-text"></i>
                    <h4 class="my-4 font-weight-bold">Adventure</h4>
                    <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                        maiores nam,
                        aperiam minima
                        assumenda deleniti hic.</p>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Best Features-->
        <hr class="hr-light">
        <!--sidebar content -->
        <div id="mySidebar" class="sidebar">
            <a class="closebtn" onclick="closeNav()">&times;</a>
            <h1 class="carlist">Car List</h1>
            <div class="card card-default">
                <div class="card text-black bg-dark mb-3" style="max-width: 18rem;">
                    <ul class="list-group text-center">
                        @foreach($cars as $cars)
                        @if($cars -> status == "available")
                        <li class="list-group-item">
                            <img src="{{ asset('image/'.$cars -> image)}}" width="100px" height="auto" alt="{{$cars -> image}}">
                            <br>
                            {{$cars->make}}&nbsp;{{$cars->model}}

                            <a href="/car_details/{{$cars->id}}" class="btn btn-dark text-center">Book</a>&nbsp;&nbsp;&nbsp;
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--sidebar button -->
        <div id="main">
            <button class="openbtn" onclick="openNav()" style="float: left">&#9776; Show Cars</button>
            <button onclick="getLocation();" data-role="button" id="find" class="btn btn-secondary btn-sm" style="display: none">Find Your Location!</button>
        </div>


        <!--fetch google map from controller -->
        <div class="map">
            {!! $map['js'] !!}
            {!! $map['html'] !!}
        </div>

        <hr class="hr-light">


        <!--Section: Contact v.2-->
        <section class="mb-4">

            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
                a matter of hours to help you.</p>

            <div class="row">

               
                <div class="col-md-9 mb-md-0 mb-5">
                    {{-- <form id="contact-form" name="contact-form" action="mail.php" method="POST"> --}}
                    <form method="POST" id="contact-form" name="contact-form" action="{{ route('sendFeedback') }}" enctype="multipart/form-data">

                     
                        <div class="row">

                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control">

                                    <label for="name" class="">Your name</label>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="email" name="email" class="form-control">
                                    <label for="email" class="">Your email</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <input type="text" id="subject" name="subject" class="form-control">
                                    <label for="subject" class="">Subject</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">

                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                    <label for="message">Your message</label>
                                </div>
                            </div>
                        </div>
                        
                    </form>

                    <div class="text-center text-md-left">
                        <a class="btn btn-secondary" onclick="validateForm();">Send</a>
                    </div>
                    <div class="status"></div>
                </div>
                
                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-location-arrow mt-4 fa-2x"></i>
                            <p>Melbourne, VIC 3000, Australia</p>
                        </li>

                        <li><i class="fa fa-phone mt-4 fa-2x"></i>
                            <p>+ 01 234 567 89</p>
                        </li>

                        <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                            <p>contact@Carabc.com</p>
                        </li>
                    </ul>
                </div>
                

            </div>

        </section>
       
        @endsection