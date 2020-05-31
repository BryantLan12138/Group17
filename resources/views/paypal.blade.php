@extends('layouts.app')
@section('content')


    <main class="py-4">


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">Paypal</div>
                        
                      
                            
                            
                                
                                <li class="list-group-item" style="color:black;">
                                    AU$
                                    {{round(($cars->unit_price*($orders->minute/60)+$cars->unit_price*$orders->hour)*1.1,2)}}
                                </li>
                                
                                
                            
                            <form action="{{ url('charge') }}" method="post" >
                            <input type="hidden" name="amount" value="<?php echo round(($cars->unit_price*($orders->minute/60)+$cars->unit_price*$orders->hour)*1.1,2) ?>" readonly>
                                {{ csrf_field() }}
                                <button class="btn btn-light" type="submit" name="submit" value="Pay Now">Pay Now</button>
                            </form>
                             

                            
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </main>


@endsection
{{-- <form method="POST" action="">
    <input type="hidden" name="_token">
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Your paypal account</label>
        <div class="col-md-6"><input id="account" type="account" name="account" required="required" autocomplete="current-password" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Your password</label>
        <div class="col-md-6"><input id="password" type="password" name="password" required="required" autocomplete="current-password" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 offset-md-4">
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <a type="submit" class="btn btn-primary" href="" class="btn btn-link">
                Pay now!
            </a>
        </div>
    </div>
</form> --}}