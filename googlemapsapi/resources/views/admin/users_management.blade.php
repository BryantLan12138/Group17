@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    Users
                    
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($users as $user)
                            <li class="list-group-item" text-indent="10px" style="color: #ffffff; background-color: #201a1a">
                                Name: {{$user -> name}} &nbsp;&nbsp;&nbsp;&nbsp;
                                Email: {{$user -> email}}
                                <a href="/admin/users_management" class="btn btn-dark float-right">Manage</a>&nbsp;&nbsp;&nbsp;
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection