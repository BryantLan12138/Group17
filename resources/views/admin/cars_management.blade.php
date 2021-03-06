@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    Cars 
                    @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                    @endif
                    &nbsp;&nbsp;&nbsp;<a href="/admin/add_car" class="btn btn-light float-right">Add a new car</a>&nbsp;&nbsp;&nbsp;
                    <div class="card-body">
                        <ul class="list-group">
                        <!-- loop to display all the cars from database -->
                            @foreach($cars as $car)
                            <li class="list-group-item" style="color: #ffffff; background-color: #201a1a"> 
                                <img src="{{ asset('image/'.$car -> image)}}" width="100px" height="auto" alt="{{$car -> image}}">&nbsp;&nbsp;&nbsp;&nbsp;
                                Licenseplate: {{$car -> licenseplate}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Make: {{$car -> make}}&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/admin/car_delete/{{$car -> id}}" class="btn btn-danger float-right">Delete</a>
                                &nbsp;&nbsp;&nbsp;<a href="/admin/cars_management/{{$car->id}}" class="btn btn-dark float-right">Edit</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div><br>
<script>
    $(document).ready(function(){
        $('.delete_form').on('submit',function(){
            if(confirm("Are you sure you want to delete it?"))
            {
                return true;
            }
            else{
                return false;
            }
        });
    });
</script>


@endsection