@extends('layouts.app')


@section('content')
    <div class="content">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="display-6">Contact Us</h3>
            </div>
        </div>
        <div class="container">
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="badge badge-primary" style="float: left;margin-right: 20px">Email</span> {{$info->email}}</li>
                    <li class="list-group-item"><span class="badge badge-success" style="float: left;margin-right: 20px">Phone</span> {{$info->phone}}</li>
                    <li class="list-group-item"><span class="badge badge-danger" style="float: left;margin-right: 20px">Address</span> {{$info->address}}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection



