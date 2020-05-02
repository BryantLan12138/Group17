@extends('layouts.app')
@section('content')


    <main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">Fees information</h2>
                    <div class="card-body">
                        <div class="links">
                            <ul class="links">
                                <li class="links">
                                    <i class="links">
                                    </i><span class="links">The calculation of the fee is still developing</span>
                                </li>
                            </ul>
                        </div>
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
                            <!-- <div class="form-group">
                              <label for="inputAddress2">Address 2</label>
                              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div> -->
                            <!-- <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                              </div> -->
                              <!-- <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                                </select>
                              </div> -->
                              <!-- <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                              </div> 
                            </div>-->
                            <button class="btn btn-primary" type="submit" name="submit">Proceed to payment</button>
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
