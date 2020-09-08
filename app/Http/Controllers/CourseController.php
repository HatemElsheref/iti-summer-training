<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
class CourseController extends Controller
{
    public function index(){
        $courses=Course::all();
        return view('session3.index',compact('courses'));
    }
    public function store(Request $request){
        $course=new Course();
        $request->validate([
           'name'=>'required|string|max:191',
           'instructor'=>'required|string|max:191',
           'code'=>'required|string|max:191',
           'price'=>'required|numeric|min:0',
           'image'=>'mimes:png,jpg,jpeg'
        ]);
        $validatedData=$request->except('image');
        $course->name=$validatedData['name'];
        $course->instructor=$validatedData['instructor'];
        $course->code=$validatedData['code'];
        $course->price=$validatedData['price'];
        if ($request->hasFile('image')){
            $course->image=$request->file('image')->store('uploads');
        }
        $course->save();
        return back();
    }
}
