<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\ExamType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamTypeController extends Controller
{
    public function index(){
        $exam_types=ExamType::all();
        //dd($exam_types);
        return view('backend.setup.exam_type.index',compact('exam_types'));
    }

    public function create(){
        return view('backend.setup.exam_type.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:exam_types',
            ],
        );
        //dd($validated);

        $exam_type=ExamType::create($validated);
        //dd($exam_type);
        $notification=[
            'message'=>'新增Exam Type成功',
            'alert-type'=>'success',
        ];
        //dd($exam_type);
        return redirect()->route('exam_type.index')->with($notification);
    }

    public function edit(ExamType $exam_type){

        return view('backend.setup.exam_type.update',compact('exam_type'));
    }

    public function update(Request $request,ExamType $exam_type){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:fee_categories',
            ],
        );
        //dd($validated);

        $exam_type=$exam_type->update($validated);
        $notification=[
            'message'=>'修改Exam Type成功',
            'alert-type'=>'success',
        ];
        //dd($exam_type);
        return redirect()->route('exam_type.index')->with($notification);
    }

    public function delete(Request $request,ExamType $exam_type){
        
        $exam_type->delete();
        $notification=[
            'message'=>'刪除Exam Type成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('exam_type.index')->with($notification);
    }
    
}
