@extends('layouts.app')
@section('content')
<!-- div for car -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    Cars  
                    <a href="/admin/map_admin" class="btn btn-light float-right">Show on map</a>&nbsp;
                    <a href="/admin/cars_management" class="btn btn-light float-right mr-1">Manage</a>&nbsp;&nbsp;&nbsp;
                    <!-- <button class="btn btn-primary btn-sm float-right">Manage</button> -->
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($cars as $car)
                            <li class="list-group-item" style="color: #ffffff; background-color: #201a1a"> 
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

<!-- div for user -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    Users
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($users as $user)
                            <li class="list-group-item" text-indent="10px" style="color: #ffffff; background-color: #201a1a">
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