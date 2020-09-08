@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-6">MY COURSES</h3>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                @include('session3.error')
                <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Course Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code">Course Code</label>
                            <input type="text" name="code" class="form-control" id="code" value="{{old('code')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Course Price</label>
                        <input type="number" name="price" step="1" min="0" class="form-control" id="price" value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                        <label for="instructor">Course Instructor</label>
                        <input type="text"  name="instructor" class="form-control" id="instructor" value="{{old('instructor')}}">
                    </div>
                    <label for="image">Course Image</label>
                    <div class="custom-file mb-3">
                        <input type="file" name="image" class="custom-file-input" id="image" >
                        <label class="custom-file-label" for="image">Choose Course Image</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Price</th>
                        <th scope="col">Instructor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <th scope="row">{{$course->id}}</th>
                        <td><img src="{{$course->image()}}" style="width: 40px;height: 40px;border-radius: 50%"></td>
                        <td>{{$course->name}}</td>
                        <td>{{$course->code}}</td>
                        <td>{{$course->price}}</td>
                        <td>{{$course->instructor}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                @foreach($courses as $course)--}}
{{--                    <div class="col-md-4 mt-5">--}}
{{--                        <div class="card" style="width: 18rem;">--}}
{{--                            <img src="{{$course->image}}" class="card-img-top" alt="...">--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title">{{$course->name}} Code : {{$course->code}}</h5>--}}
{{--                                <p class="card-text">{{$course->instructor}}</p>--}}
{{--                                <p class="card-text">{{$course->price}}</p>--}}
{{--                                <a href="#" class="btn btn-primary">Buy Now</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>


        </div>
    </div>
@endsection