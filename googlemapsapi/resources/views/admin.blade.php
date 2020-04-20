@extends('layouts.app')
@section('content')
<!-- div for order -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    Orders  
                    <button class="btn btn-primary btn-sm float-right">Manage</button>
                    <div class="card-body">
                        <ul class="list-group">
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div><br>

<!-- div for car -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    Cars  
                    <button class="btn btn-primary btn-sm float-right">Manage</button>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($cars as $car)
                            <li class="list-group-item"> 
                                <img src="{{ asset('image/'.$car -> image)}}" width="100px" height="auto" alt="{{$car -> image}}">&nbsp;&nbsp;&nbsp;&nbsp;
                                Licenseplate: {{$car -> licenseplate}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Make: {{$car -> make}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Model: {{$car -> model}}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div><br>

<!-- div for carpark -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    Carparks
                    <button class="btn btn-primary btn-sm float-right">Manage</button>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($carparks as $carpark)
                            <li class="list-group-item">
                                {{$carpark -> carpark}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Address: {{$carpark -> address}}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div><br>
<!-- div for user -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    Users
                    <button class="btn btn-primary btn-sm float-right">Manage</button>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($users as $user)
                            <li class="list-group-item" text-indent="10px">
                                Name: {{$user -> name}} &nbsp;&nbsp;&nbsp;&nbsp;
                                Email: {{$user -> email}}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection