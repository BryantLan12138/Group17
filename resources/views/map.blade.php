<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    html, body, footer{
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carabc</title>

    <ul>
        <li><a class="active" href="http://127.0.0.1/Group17/googlemapsapi/public/googlemap">Home page</a></li>
        <li><a href="">News</a></li>
        <li><a href="">Contact</a></li>
        <li><a href="">About</a></li>
    </ul>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>

        html, body, footer {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .map{
            margin:auto;
            width:70%;
            border:3px solid green;
            padding:10px;
        }

        #directionsDiv{
            margin:auto;
            width:70%;
            border:3px solid green;
            padding:10px;

        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }


        .m-b-md {
            margin-bottom: 30px;
        }

        .footer {
            position:fixed;
            text-align: center;
            bottom:0;
            left:0;
            width:100%;
            height:5%;
            background-color:#cad7de;
            text-decoration: none;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            border: 1px solid #e7e7e7;
            background-color: #cad7de;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: #666;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #eee;
        }

        li a.active {
            color: white;
            background-color: #4CAF50;
        }
    </style>
    {!! $map['js'] !!}
</head>
<body>
<div class="content">
    <div class="title m-b-md">
        Carabc
    </div>
    <div class="map">
        {!! $map['html'] !!}
    </div>
    <div id="directionsDiv"></div>
</div>

</body>

<footer >
<div class="footer">
    <p >Copyright &copy; Group17.Go <a href="#top">top</a></p>
</div>
</footer>

</html>

