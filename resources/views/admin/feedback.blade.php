@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    Feedback   
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($feedbacks as $feedback)
                            <li class="list-group-item" style="color: #ffffff; background-color: #201a1a"> 
                                <div style="color:grey">{{$feedback -> created_at}}<br>
                                From: {{$feedback -> name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: {{$feedback -> email}}
                                </div><br>
                                <h5>{{$feedback -> subject}}</h5>
                                {{$feedback -> message}}<br><br>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div><br>


@endsection