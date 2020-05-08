@extends('layouts.app')
@section('content')
<script type="text/javascript">
    setTimeout(function() {
        window.location.href = '/';
    }, 5000); //redirect user to home page in 5 seconds.
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment</div>
                <div class="card-body">
                    Payment is successful. <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection