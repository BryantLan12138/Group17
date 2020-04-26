@extends('layouts.app')
@section('content')


    <main class="py-4">


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Paypal</div>
                        <div class="card-body">
                            <form method="POST" action="">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </main>


@endsection
