@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-6">All Students</h3>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message') and !empty(session()->get('message')))
                    <div class="alert alert-{{session()->get('type')}}">{{session()->get('message')}}</div>
                @endif
                    <a href="{{route('students.create')}}" class="btn btn-sm btn-primary mb-2"><i class="fa fa-plus"></i> Add New Student</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($students as $student)
                        <tr>
                            <th scope="row">{{$student->id}}</th>
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->gender}}</td>
                            <td>{{$student->phone}}</td>
                            <td>
                                <a href="{{route('students.edit',$student->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="document.getElementById('remove-student-{{$student->id}}').submit();return false;"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                            <form action="{{route('students.destroy',$student->id)}}" method="post" id="remove-student-{{$student->id}}">@csrf @method('delete')</form>
                        </tr>
                        @empty
                        <tr class="text-center"><td colspan="6">No Student Founded</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection