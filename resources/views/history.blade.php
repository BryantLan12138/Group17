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
                                <br>
                                Payment status:&nbsp;{{\App\Order::where(['id' => $report -> order_id])->first()->status}}

                                <br>Amount: AU$<?php echo round(($report->unit_price*($report->minute/60)+$report->unit_price*$report->hour)*1.1,2)?>

                                @if (\App\Order::where(['id' => $report -> order_id])->first()->status == 'unpaid')

                                {{ session()->put('order_id',$report -> order_id)}}

                                <form action="{{ url('charge') }}" method="post" >

                            <input type="hidden" name="amount" value="<?php echo round(($report->unit_price*($report->minute/60)+$report->unit_price*$report->hour)*1.1,2) ?>" readonly>

                                {{ csrf_field() }}

                                <button class="btn btn-secondary float-left" type="submit" name="submit" value="Pay Now">Pay Now</button>

                            </form>

                                @endif
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