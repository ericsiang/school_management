<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class SchoolSubjectController extends Controller
{
    public function index(){
        $school_subjects=SchoolSubject::all();
        //dd($school_subjects);
        return view('backend.setup.school_subject.index',compact('school_subjects'));
    }

    public function create(){
        return view('backend.setup.school_subject.add');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:school_subjects',
            ],
        );
        //dd($validated);

        $school_subject=SchoolSubject::create($validated);
        //dd($school_subject);
        $notification=[
            'message'=>'新增School Subject成功',
            'alert-type'=>'success',
        ];
        //dd($school_subject);
        return redirect()->route('school_subject.index')->with($notification);
    }

    public function edit(SchoolSubject $school_subject){

        return view('backend.setup.school_subject.update',compact('school_subject'));
    }

    public function update(Request $request,SchoolSubject $school_subject){
        //dd($request->all());
        $validated=$request->validate(
            [
                'name'=>'required|unique:fee_categories',
            ],
        );
        //dd($validated);

        $school_subject=$school_subject->update($validated);
        $notification=[
            'message'=>'修改School Subject成功',
            'alert-type'=>'success',
        ];
        //dd($school_subject);
        return redirect()->route('school_subject.index')->with($notification);
    }

    public function delete(Request $request,SchoolSubject $school_subject){
        
        $school_subject->delete();
        $notification=[
            'message'=>'刪除School Subject成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('school_subject.index')->with($notification);
    }
    
}
