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
        <a  class="closebtn" onclick="closeNav()">&times;</a>
        <h1 class="text-center my-5">Car List</h1>
        <div class="card card-default">
            <div class="card card-body">
            <ul class="list-group">
                @foreach($cars as $cars)

                <li class="list-group-item">
                    <img src="{{ asset('image/'.$cars -> image)}}" width="100px" height="auto" alt="{{$cars -> image}}">
                       {{$cars->make}}{{$cars->model}}
                    <a href="/car_details/{{$cars->id}}" class="btn btn-dark ">Details</a>&nbsp;&nbsp;&nbsp;
                </li>
                @endforeach
            </ul>
            </div>
        </div>
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()" style="float: left" >&#9776; Show Cars</button>
    </div>
@endsection
