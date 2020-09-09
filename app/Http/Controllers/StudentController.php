<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $students=Student::all();
        return view('session4.index',compact('students'));
    }

    public function create()
    {
        return view('session4.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:191',
            'email'=>'required|string|max:191|unique:students,email',
            'phone'=>'required|numeric|unique:students,phone',
            'gender'=>'required|in:male,female'
        ]);
        $validatedData=$request->except(['_token']);
        $student=Student::create($validatedData);
        if ($student){
            $this->alert('success','Student Added Successfully');
            return redirect()->route('students.index');
        }
        $this->alert('danger','Failed To Add Student');
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return view('session4.edit',compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'=>'required|string|max:191',
            'email'=>'required|string|max:191|unique:students,email,'.$student->id.',id',
            'phone'=>'required|numeric|unique:students,phone,'.$student->id.',id',
            'gender'=>'required|in:male,female'
        ]);
        $validatedData=$request->except(['_token','_method']);
        if ($student->update($validatedData)){
            $this->alert('success','Student Updated Successfully');
            return redirect()->route('students.index');
        }
        $this->alert('danger','Failed To Update Student');
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        if ($student->delete()){
            $this->alert('success','Student Deleted Successfully');
            return redirect()->route('students.index');
        }
            $this->alert('danger','Failed To Delete Student');
            return redirect()->route('students.index');
    }

    private function alert($type='success',$message='Success Operation'){
        session()->flash('message',$message);
        session()->flash('type',$type);
    }
}
