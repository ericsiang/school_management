<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentYearController extends Controller
{
    public function index(){
        $student_years=StudentYear::all();
        return view('backend.setup.student_year.index',compact('student_years'));
    }

    public function create(){
        return view('backend.setup.student_year.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_years,name|numeric',
            ],
        );
        //dd($validated);

        $student_year=StudentYear::create($validated);
        $notification=[
            'message'=>'新增Student Year成功',
            'alert-type'=>'success',
        ];
        //dd($student_year);
        return redirect()->route('student_year.index')->with($notification);
    }

    public function edit(StudentYear $student_year){

        return view('backend.setup.student_year.update',compact('student_year'));
    }

    public function update(Request $request,StudentYear $student_year){
        //dd($student_year);
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_years,name|numeric',
            ],
        );
        //dd($validated);

        $student_year=$student_year->update($validated);
        $notification=[
            'message'=>'修改Student Year成功',
            'alert-type'=>'success',
        ];
        //dd($student_year);
        return redirect()->route('student_year.index')->with($notification);
    }

    public function delete(Request $request,StudentYear $student_year){
        $student_year->delete();
        $notification=[
            'message'=>'刪除Student Year成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('student_year.index')->with($notification);
    }
}
