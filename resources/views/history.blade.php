@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking history</div>

                <div class="card-body">

                <ul class="list-group">
                            <?php $count=1; ?>
                            @foreach($reports as $report)
                            <li class="list-group-item"> 
                                Order <?php echo $count++; ?>: &nbsp;&nbsp;&nbsp;&nbsp; 
                                {{$report -> created_at}}&nbsp;&nbsp;&nbsp;&nbsp; 
                                <br>
                                Start Location:&nbsp;{{$report -> start_location}}
                                <br>
                                End Location:&nbsp;{{$report -> end_location}}
                                <a href="/booking_history/{{$report->order_id}}" class="btn btn-dark float-right">Details</a>
                            </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection