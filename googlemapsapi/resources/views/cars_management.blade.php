@extends('layouts.app')
@section('content')

<!-- div for car -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    Cars  
                    &nbsp;&nbsp;&nbsp;<a href="/add_car" class="btn btn-dark float-right">Add a new car</a>&nbsp;&nbsp;&nbsp;
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($cars as $car)
                            <li class="list-group-item"> 
                                <img src="{{ asset('image/'.$car -> image)}}" width="100px" height="auto" alt="{{$car -> image}}">&nbsp;&nbsp;&nbsp;&nbsp;
                                Licenseplate: {{$car -> licenseplate}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Make: {{$car -> make}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Model: {{$car -> model}}</br>
                                
                                &nbsp;&nbsp;&nbsp;<a href="/cars_management" class="btn btn-dark float-right">Delete</a>&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;<a href="/cars_management/{{$car->id}}" class="btn btn-dark float-right">Update</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div><br>


@endsection