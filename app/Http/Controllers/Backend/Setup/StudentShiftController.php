<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentShiftController extends Controller
{
    public function index(){
        $student_shifts=StudentShift::all();
        return view('backend.setup.student_shift.index',compact('student_shifts'));
    }

    public function create(){
        return view('backend.setup.student_shift.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_shifts',
            ],
        );
        //dd($validated);

        $student_shift=StudentShift::create($validated);
        $notification=[
            'message'=>'新增Student Shift成功',
            'alert-type'=>'success',
        ];
        //dd($student_shift);
        return redirect()->route('student_shift.index')->with($notification);
    }

    public function edit(StudentShift $student_shift){

        return view('backend.setup.student_shift.update',compact('student_shift'));
    }

    public function update(Request $request,StudentShift $student_shift){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_shifts',
            ],
        );
        //dd($validated);

        $student_shift=$student_shift->update($validated);
        $notification=[
            'message'=>'修改Student Shift成功',
            'alert-type'=>'success',
        ];
        //dd($student_shift);
        return redirect()->route('student_shift.index')->with($notification);
    }

    public function delete(Request $request,StudentShift $student_shift){
        $student_shift->delete();
        $notification=[
            'message'=>'刪除Student Shift成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('student_shift.index')->with($notification);
    }
}
