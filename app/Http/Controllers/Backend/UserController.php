<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $users=User::all();

        return view('backend.user.index',compact('users'));
    }

    public function create(){
        return view('backend.user.add_user');
    }

    public function store(Request $request){

        $validated=$request->validate(
            [
                'usertype'=>'required',
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required'
            ],
        );
        $validated['password']=bcrypt($request->password);

        $user=User::create($validated);
        $notification=[
            'message'=>'新增User成功',
            'alert-type'=>'success',
        ];
        //dd($user);
        return redirect()->route('user.index')->with($notification);
    }

    public function edit(Request $request,User $user){
        return view('backend.user.update_user',compact('user'));
    }

    public function update(Request $request,User $user){
        // dd($request->all());
        $validated=$request->validate(
            [
                'usertype'=>'required',
                'name'=>'required',
                'email'=>'required|email',
                //'password'=>'required'
            ],
        );
        if($request->password){
            $validated['password']=bcrypt($request->password);
        }


        $user->update($validated);
        $notification=[
            'message'=>'修改User成功',
            'alert-type'=>'success',
        ];
        return redirect()->route('user.index')->with($notification);
    }

    public function delete(Request $request,User $user){
        $user->delete();
        $notification=[
            'message'=>'刪除User成功',
            'alert-type'=>'info',
        ];
        return redirect()->route('user.index')->with($notification);
    }
}
