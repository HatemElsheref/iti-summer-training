@extends('layouts.app')


@section('content')
    <div class="content">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="display-6">All Customers</h3>
            </div>
        </div>
      <div class="container">
          <div class="row">
              @foreach($clients as $client)
              <div class="col-md-4 mt-5">
                      <ul class="list-group">
                          <li class="list-group-item active">{{$client['title']}}</li>
                          <li class="list-group-item">{{$client['name']}}</li>
                          <li class="list-group-item">{{$client['address']}}</li>
                          <li class="list-group-item">{{$client['age']}}</li>
                          <li class="list-group-item">{{$client['email']}}</li>
                      </ul>
              </div>
              @endforeach
          </div>
      </div>
    </div>
@endsection



