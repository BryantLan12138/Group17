<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Carabc</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
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

        .carlist{
            font-family: 'Nunito', sans-serif;
            color: whitesmoke;
            text-align: center;
        }


        html, body {
            background-color: #fff;
            color:black; 
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        #intro{
            background-color: #fff;
            color:#fff; 
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 200vh;
            margin: 0;
        }

        .map{
            margin: auto;
            position: relative;
            left:-10%;
            width: 71%;
            padding: 5px;
        }

        .map1 {
            margin: auto;
            position: absolute;
            left: 50%;
            top: 0%;
            padding: 5px;
        }


        .card-text {
            font-family: 'Nunito', sans-serif;
            color:black;
        }

        #intro {
            height: 100%;
        }

        #intro {
            font-family: 'Nunito', sans-serif;
            background: url("/image/melbourne.jpg")no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }


        .content {
            text-align: center;
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
            position: relative;
            top: 0px;
            left: -10%;
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
            top:20%;
            padding: 20px;
        }
        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 650px) {
            .sidebar {padding-top: 15px;}
            .sidebar a {font-size: 18px;}
        }

        /* booking expired alert box */
        #dialogoverlay{
            display:none;
            opacity: .8;
            position:fixed;
            top:0px;
            left:0px;
            background:#FFF;
            width:100%;
            z-index:10;
        }

        #dialogbox{
            display:none;
            position:fixed;
            background:#666;
            border-radius:7px;
            width:550px;
            z-index:10;
        }
        #dialogbox > div{
             
            margin:8px;
        }
        #dialogbox > div > #dialogboxhead{
            background:#666;
            font-size:19px;
            padding:10px;
            color:#CCC;
        }
        #dialogbox > div > #dialogboxbody{
            /* background:#333;  */
            padding:20px;
            color:#FFF;
        }
        #dialogbox > div > #dialogboxfoot{
            background:#666;
            padding:10px;
            text-align:right;
        }
    

    </style>
</head>
<body>
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
                    @guest
                        <li class="nav-item">
                            <li>                           
                            <svg class="bi bi-people-circle" id="login-icon" width="15px" height="15px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                              </svg>
                            </li>
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}&nbsp;&nbsp;&nbsp;</a>
                            
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <li>                           
                                    <svg class="bi bi-people-circle" id="login-icon" width="15px" height="15px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                                        <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                                      </svg>
                                    </li>
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>                           
                            <svg class="bi bi-people-circle" id="login-icon" width="15px" height="15px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                            </svg>
                        </li>
                        <li class="nav-item dropdown">
                            
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!-- Dropdown list item for admin management -->
                                @if(Auth::user()->is_admin)
                                <a class="dropdown-item" href="/admin">{{ __('Admin Management') }}</a>
                                <a class="dropdown-item" href="/admin/feedback">{{ __('Feedback') }}</a>
                                @endif
                                <!-- Dropdown list item for directing user to report -->
                                @if(Auth::user()->is_admin == false)
                                <a class="dropdown-item" href="/booking_history">{{ __('Booking history') }}</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>



                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    &nbsp;&nbsp;&nbsp;
                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item">
                            <a href="https://www.facebook.com" class="nav-link"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.twitter.com" class="nav-link"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.instagram.com" class="nav-link"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>

    <!--Mask-->
    <div id="intro" class="view">

        <div class="mask rgba-black-strong">

            <div class="container-fluid d-flex align-items-center justify-content-center h-100">

                <div class="row d-flex justify-content-center text-center">

                    <div class="col-md-10">

                        <!-- Heading -->
                        <h2 class="display-3 font-weight-bold white-text pt-5 mb-2">Carabc</h2>

                        <!-- Divider -->
                        <hr class="hr-light">

                        <!-- Description -->
                        <h4 class="white-text my-4">Why rent if you can share?</h4>
                        <button type="button" class="btn btn-outline-white" data-toggle="collapse" data-target="#aboutus" aria-expanded="false" aria-controls="aboutus">Read more<i class="fa fa-book ml-2"></i></button>
                        <div class="collapse" id="aboutus">
                            <div class="card text-white bg-transparent mb-3" style="max-width: 18rem;">
                                Carabc services provide cars on demand, pick the nearest car from your location anytime anywhere from our app, and no parking hassles when done.
                            </div>
                          </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!--/.Mask-->



    
   
            
    <main class="py-4">
        @yield('content')
    </main>

    <hr class="hr-light">
    
    <footer class="container py-5">
        <div class="row">
          <div class="col-12 col-md">
       
            <small class="d-block mb-3 text-muted">Carabc is designed by &copy;Group17</small>
          </div>
          
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="about">Team</a></li>
              
            </ul>
          </div>
        </div>
      </footer>
    </div>
</body>
</html>
