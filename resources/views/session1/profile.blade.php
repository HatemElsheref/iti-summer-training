@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-6">  {{$info->message}}</h3>
        </div>
    </div>
    <div class="content">
        <div class="title m-b-md">

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form>
                        <h3>My Information is</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{$info->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{$info->email}}" readonly>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



