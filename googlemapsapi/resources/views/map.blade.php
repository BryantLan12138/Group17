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
    </div>
    <div id="main">
        <button class="openbtn" onclick="openNav()" style="float: left" >&#9776; Show Cars</button>    
    </div>        
</div>
@endsection