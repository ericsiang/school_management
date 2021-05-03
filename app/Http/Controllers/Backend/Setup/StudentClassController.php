<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentClassController extends Controller
{
    public function index(){
        $student_classes=StudentClass::all();
        return view('backend.setup.student_class.index',compact('student_classes'));
    }

    public function create(){
        return view('backend.setup.student_class.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_classes',
            ],
        );
        //dd($validated);

        $student_class=StudentClass::create($validated);
        $notification=[
            'message'=>'新增Student Class成功',
            'alert-type'=>'success',
        ];
        //dd($student_class);
        return redirect()->route('student_class.index')->with($notification);
    }

    public function edit(StudentClass $student_class){

        return view('backend.setup.student_class.update',compact('student_class'));
    }

    public function update(Request $request,StudentClass $student_class){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_classes',
            ],
        );
        //dd($validated);

        $student_class=StudentClass::update($validated);
        $notification=[
            'message'=>'修改Student Class成功',
            'alert-type'=>'success',
        ];
        //dd($student_class);
        return redirect()->route('student_class.index')->with($notification);
    }

    public function delete(Request $request,StudentClass $student_class){
        $student_class->delete();
        $notification=[
            'message'=>'刪除User成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('student_class.index')->with($notification);
    }

}
