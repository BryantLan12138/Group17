<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carabc</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Styles -->
    <style>

        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .map{
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translate(-50%,0%);
        }

        #directionsDiv{

            height: 1000px;
            width: 1000px;
            position: absolute;
            left: 50%;
            transform: translate(-500px,500px);
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
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

        .m-b-md {
            margin-bottom: 30px;
        }
        /*CSS below credit to W3school reference: https://www.w3schools.com/howto/howto_js_collapse_sidebar.asp */
        .sidebar{
            height: 100%; 
            width: 0; 
            position: fixed; 
            z-index: 1; 
            top: 0;
            left: 0;
            background-color: #111; 
            overflow-x: hidden; 
            padding-top: 60px; 
            transition: 0.5s; 
        }

        .sidebar a{
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }
        
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        #main {
            transition: margin-left .5s; /* If you want a transition effect */
            padding: 20px;
        }
        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
        .sidebar {padding-top: 15px;}
        .sidebar a {font-size: 18px;}
        }

    </style>
    {!! $map['js'] !!}
</head>
<body>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

<div class="content">
    <div class="title m-b-md">
        Carabc
    </div>
    <div class="map">
        {!! $map['html'] !!}
    </div>
    <div id="directionsDiv">

    </div>
    

            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#">About</a>
                <ul>
                    @foreach($cars as $cars)
                    <li>
                        {{$cars->address}}    
                    </li>
                    @endforeach
                
                </ul>
            </div>

            <div id="main">
                <button class="openbtn" onclick="openNav()" style="float: left" >&#9776; Show Cars</button>    
            </div>        

    </body>
</html>
