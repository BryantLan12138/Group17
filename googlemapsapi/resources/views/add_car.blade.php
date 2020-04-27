@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a new car</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('car_store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                        <label for="car_image" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="file-input">
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="car_licenseplate" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                                <input type="text" name="image" class="form-control">
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="car_licenseplate" class="col-md-4 col-form-label text-md-right">Licenseplate</label>
                            <div class="col-md-6">
                                <input type="text" name="licenseplate" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="car_make" class="col-md-4 col-form-label text-md-right">Make</label>
                            <div class="col-md-6">
                                <input type="text" name="make" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="car_model" class="col-md-4 col-form-label text-md-right">Model</label>
                            <div class="col-md-6">
                                <input type="text" name="model" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="car_address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <input type="text" name="address" class="form-control">
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