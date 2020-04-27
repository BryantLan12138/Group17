@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img src="{{ asset('image/'.$cars -> image)}}" width="100px" height="auto" alt="{{$cars -> image}}">&nbsp;&nbsp;&nbsp;&nbsp;
                                Licenseplate: {{$cars -> licenseplate}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Make: {{$cars -> make}}&nbsp;&nbsp;&nbsp;&nbsp;
                                Model: {{$cars -> model}}</br>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div><br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit form</div>
                <div class="card-body">

                <form method="POST" action="{{ route('car_update',$cars->id) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="car_licenseplate" class="col-md-4 col-form-label text-md-right">Licenseplate</label>
                            <div class="col-md-6">
                                <input type="text" name="licenseplate" class="form-control" value="{{$cars -> licenseplate}}">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="car_address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <input type="text" name="address" class="form-control" value="{{$cars -> address}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                            <button type="submit" name="submit" class="btn btn-dark">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>


@endsection