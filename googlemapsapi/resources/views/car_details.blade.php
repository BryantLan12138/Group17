@extends('layouts.app')

@section('content')
<body>
    <div class="container">
        <h1 class="text-center" my-5>
        Car No. &nbsp;&nbsp;{{$cars->id}}&nbsp;&nbsp;&nbsp; Licenseplate:&nbsp;&nbsp;{{$cars->licenseplate}}
        </h1> 
            <div class="card card-default">
                <div class="card-header">
                    Details
                </div>
            <div class="card card-body">
                {{$cars->make}}&nbsp;&nbsp;{{$cars->model}} &nbsp;
                <br>locate at:&nbsp;&nbsp; {{$cars->address}}
            <img src="{{ asset('image/'.$cars -> image)}}" width="500px" height="auto" alt="{{$cars -> image}}">
            </div>


    </div>
</body>

@endsection