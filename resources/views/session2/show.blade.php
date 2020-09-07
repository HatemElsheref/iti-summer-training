@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-6"> Post Title : {{ucwords($post['title'])}}</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <h5 class="card-title">   </h5>
        </div>
        <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="card" style="/*width: 18rem;">
                        <img src="https://source.unsplash.com/user/erondu/1600x900" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">{{$post['content']}}</p>
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection