@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-6">Edit Student</h3>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                @include('session3.error')
                <form method="post" action="{{route('students.update',$student->id)}}">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Student Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$student->name}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="phone">Student Phone</label>
                            <input type="text" name="phone"  class="form-control" id="phone" value="{{$student->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Student Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{$student->email}}">
                    </div>
                    <label for="phone">Student Gender</label>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="gender-male" name="gender" class="custom-control-input" value="male" @if($student->gender==='male') checked @endif>
                        <label class="custom-control-label" for="gender-male">Male</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="gender-female" name="gender" class="custom-control-input" value="female" @if($student->gender==='female') checked @endif>
                        <label class="custom-control-label" for="gender-female">Female</label>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">
                        <i class="fa fa-edit"></i>
                        Save
                    </button>
                    <a href="{{URL::previous()}}" class="btn btn-danger mt-3">
                        <i class="fa fa-times"></i>
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection