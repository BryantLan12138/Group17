@extends('layouts.app')
@section('content')

<script type="text/javascript">
    setTimeout(function() {
        window.location.href = '/';
    }, 2000);//redirect user to home page in 2 seconds.
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cancel Booking</div>

                <div class="card-body">


                Booking canceled! <br>
                Directing to home page in 2 seconds...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection