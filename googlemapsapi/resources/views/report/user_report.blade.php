@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order number: ODS62CJIA03023KNLVS </div>

                <div class="card-body">

                    <?php date_default_timezone_set("Australia/Melbourne");
                    $now = date('d/m/Y H:i:s'); 
                    $gst_number = $reports[0] -> charge / 11;
                    $gst = number_format($gst_number, 2, '.', '');
                    ?>
                    <h3>Carabc</h3>
                    <p>Building 14, RMIT, Melbourne</p>
                    <p>ABN: 00-123-456-789</p>
                    <p><?php echo $now; ?></p>
                    <hr>

                    <table style="width:100%">
                        <tr>
                            <th colspan="4">Customer Information<br><br></th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Mobile</th>
                        </tr>
                        <tr>
                            <td>{{$reports[0] -> email}}</td>
                            <td>{{$reports[0] -> firstname}}</td>
                            <td>{{$reports[0] -> lastname}}</td>
                            <td>{{$reports[0] -> mobile}}</td>
                        </tr>
                        <tr><th colspan="4">Address</th></tr>
                        <tr><td colspan="4">{{$reports[0] -> user_address}}</td></tr>
                    </table>
                    <hr>
                    <table style="width:100%">
                        <tr>
                            <th colspan="4">Booking Information<br><br></th>
                        </tr>
                        <tr><th colspan="4">Start location</th></tr>
                        <tr><td colspan="4">{{$reports[0] -> start_location}}</td></tr>
                        <tr><th colspan="4">End location</th></tr>
                        <tr><td colspan="4">{{$reports[0] -> end_location}}</td></tr>
                        <tr>
                            <th>Date and Time</th>
                            <th>Booking duration</th>
                            <th>Car licenseplate</th>
                            <th>Car Make/Model</th>
                        </tr>
                        <tr>
                            <td>{{$reports[0] -> created_at}}</td>
                            <td>{{$reports[0] -> duration_hour}}hrs</td>
                            <td>{{$reports[0] -> licenseplate}}</td>
                            <td>{{$reports[0] -> make}}|{{$reports[0] -> model}}</td>
                        </tr>
                        <tr><th></th><th></th><th colspan="2"><hr>Charge</th></tr>
                        <tr><td></td><td></td><td colspan="2">AU$ {{$reports[0] -> charge}}<br>( 9.09% GST inclusive: AU$ <?php echo $gst;?> )</td></tr>

                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection