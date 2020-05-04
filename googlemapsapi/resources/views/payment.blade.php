@extends('layouts.app')
@section('content')

    <main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
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
        </div></div><br>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
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
                    <div class="card">
                        <div class="card-header">Your Details</div>
                        <form>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="email" class="form-control" id="inputEmail4">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="inputPassword4">Second Name</label>
                                <input type="password" class="form-control" id="inputPassword4">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress">Address</label>
                              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Address 2</label>
                              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                              </div>
                              <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                                </select>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                  Check me out
                                </label>
                              </div>
                            </div>
                            <a href="/car_details/{{$cars->id}}/payment/paypal" type="submit" class="btn btn-dark">Pay now</a>
                          </form>
                          
                        {{-- <div class="card-body">
                            <form method="POST" action="">
                                <input type="hidden" name="_token">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right" placeholder="Your name" autofocus required>Your name</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" name="email" value="" required="required" autocomplete="email" autofocus="autofocus" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Your phone number</label>
                                    <div class="col-md-6"><input id="number" type="number" name="number" required="required" autocomplete="current-password" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Billing email-address</label>
                                    <div class="col-md-6"><input id="email" type="email" name="email" required="required" autocomplete="current-password" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <a type="submit" class="btn btn-primary" href="/paypal" class="btn btn-link">
                                            Book now!
                                        </a>
                                        <a type="submit" class="btn btn-primary" href="" class="btn btn-link">
                                            Book later!
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
