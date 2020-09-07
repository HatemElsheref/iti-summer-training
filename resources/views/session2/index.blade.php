@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-6">MY BLOG</h3>
        </div>
    </div>
    <div class="container mt-5">

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mt-5">
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/user/erondu/1600x900" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$post['title']}}</h5>
                            <p class="card-text">{{$post['content']}}</p>
                            <a href="{{route('posts.show',$post['id'])}}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection