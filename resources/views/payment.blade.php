@extends('layouts.app')
@section('content')


    <main class="py-4">



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
            <h2 class="card-header">Good choice!</h2>
            <div class="card-body">
                <div class="links">
                    Carabc services provide cars on demand, for rent either by the hour or by the day, and no parking hassles when done.<br>
                    You register with a car share company, pay a fee and book a car either by phone or on the internet. Cars are picked up and dropped off at car share bays nearest to your location. Compare price structures, locations and service provision to work out which company best suits you and register on their website.
                </div>
            </div>
        </div>
    </div>
        </div></div><br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">Supplier Location!</h2>
                    <div class="card-body">
                        <div class="links">
                            <ul class="links">
                                <li class="links">
                                    <i class="links">
                                    </i><span class="links">will list some Supplier Location</span>
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
                                            Car No. {{$cars->id}} &nbsp; 
                                            <br>
                                            Licenseplate:{{$cars->licenseplate}}
                                        </span>

                                        <span class="text-center" my-5>
                                            <br>
                                            locate at:{{$cars->address}}
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
                        <div class="card-header">Payment form</div>
                        <div class="card-body">
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
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Bill email address</label>
                                    <div class="col-md-6"><input id="email" type="email" name="email" required="required" autocomplete="current-password" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <a type="submit" class="btn btn-primary" href="http://127.0.0.1:8000/paypal" class="btn btn-link">
                                            Book now!
                                        </a>
                                        <a type="submit" class="btn btn-primary" href="" class="btn btn-link">
                                            Book later!
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
