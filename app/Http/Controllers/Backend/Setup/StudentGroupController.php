<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentGroupController extends Controller
{
    public function index(){
        $student_groups=StudentGroup::all();
        return view('backend.setup.student_group.index',compact('student_groups'));
    }

    public function create(){
        return view('backend.setup.student_group.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_groups',
            ],
        );
        //dd($validated);

        $student_group=StudentGroup::create($validated);
        $notification=[
            'message'=>'新增Student Group成功',
            'alert-type'=>'success',
        ];
        //dd($student_group);
        return redirect()->route('student_group.index')->with($notification);
    }

    public function edit(StudentGroup $student_group){

        return view('backend.setup.student_group.update',compact('student_group'));
    }

    public function update(Request $request,StudentGroup $student_group){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:student_groups',
            ],
        );
        //dd($validated);

        $student_group=$student_group->update($validated);
        $notification=[
            'message'=>'修改Student Group成功',
            'alert-type'=>'success',
        ];
        //dd($student_group);
        return redirect()->route('student_group.index')->with($notification);
    }

    public function delete(Request $request,StudentGroup $student_group){
        $student_group->delete();
        $notification=[
            'message'=>'刪除Student Group成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('student_group.index')->with($notification);
    }
}
