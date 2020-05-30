@extends('layouts.app')
@section('content')
<script type="text/javascript">
    setTimeout(function() {
        window.location.href = '/';
    }, 5000); //redirect user to home page in 5 seconds.
</script>
<div class="row d-flex justify-content-center text-center">
    <h1 class="display-3 font-weight-bold white-text pt-5 mb-2">We have recieved your feedback</h1>
</div>
@endsection