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
                                Charge: AU$ 22.00&nbsp;&nbsp;&nbsp;&nbsp;
                                Status: Payed&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/booking_history/{{$report->id}}" class="btn btn-dark float-right">Details</a>
                            </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection