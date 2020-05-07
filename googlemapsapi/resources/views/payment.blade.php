@extends('layouts.app')
@section('content')

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-dark mb-3">
                    <h2 class="card-header">Cost Breakdown</h2>
                    <div class="card-body">

                        <br>
                        <p>
                            There are numbers of different surcharges and fees that contribute to the car share rate on
                            your screen. Here is a guide to help you how the car share price structure works.
                            <br><br>
                            Base rate: is the base cost of your rental car before any relevent taxes and surcharges have been added.
                            <br><br>
                            Admin Fees & Goods and Services Tax(GST): 10% of the base rate
                            <br><br>
                            Duration: Interval between start leasing the car and returning the car
                            <br><br>
                            Cost: Refer to the final amount of charges

                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-dark mb-3">
                    <h2 class="card-header">Your Order Information</h2>
                    <div class="card-body">
                        <div class="links">
                            <ul class="links">


                                <img src="{{ asset('image/'.$cars -> image)}}" width="200px" height="auto" alt="{{$cars -> image}}">
                                <span class="text-center" my-5>
                                    <br>
                                    Car Model: {{$cars->model}} &nbsp;
                                    <br>
                                    Licenseplate:&nbsp;&nbsp;&nbsp;{{$cars->licenseplate}}
                                </span>

                                <span class="text-center" my-5>
                                    <br>
                                    Find Your Car at:&nbsp;&nbsp;&nbsp;{{$cars->address}}
                                </span>

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
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">Your Details</div>
                    <form method="POST" action="{{ route('user_report',$cars->id) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="order_id" class="form-control" value="{{session('order_id')}}">
                        <input type="hidden" name="car_id" class="form-control" value="{{$cars->id}}">
                        <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputFirstname">First Name</label>
                                <input type="text" name="firstname" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputLastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputMobile">Contact number</label>
                                <input type="text" name="mobile" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" name="user_address" class="form-control" required>
                        </div>
                        <button class="btn btn-light" type="submit" name="submit">Proceed to payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection