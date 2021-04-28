<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    public function index(){
        $user=Auth::user();

        return view('backend.user.profile',compact('user'));
    }

    public function edit(){
        $user=Auth::user();
        return view('backend.user.update_profile',compact('user'));
    }

    public function edit_pass(){
        $user=Auth::user();
        return view('backend.user.update_profile_pass',compact('user'));
    }

    public function update(Request $request,User $user){
        $validated=$request->validate(
            [
                'name'=>'required',
                'email'=>'required|email',
                'mobile'=>'required|regex:/^09[0-9]{8}$/',
                'add'=>'required',
                'gender'=>'required',
                'img'=>'mimes:jpg,jpeg,png',
            ],
            [
                'required'=>'請輸入:attribute',
                'email'=>'確認email格式',
                'mimes'=>'圖片格式為jpg,jpeg,png',
                'regex'=>'請輸入正確的手機號碼'
            ]
        );

        if($request->file('img')){
            $new_img=$request->file('img');
            //刪除原有圖片
            if(file_exists(public_path('upload/user_images/'.$user->img))){
                @unlink(public_path('upload/user_images/'.$user->img));
            }

            //使用Image套件上傳圖片
            $img_name=hexdec(uniqid()).'.'.strtolower($new_img->getClientOriginalExtension());
            $store_src='upload/user_images/'.$img_name;
            Image::make($new_img)->resize(200,200)->save($store_src);
            $validated['img']=$store_src;
        }
        //dd($user);

        $notification=[
            'message'=>'修改User Profile成功',
            'alert-type'=>'success',
        ];
        $user->update($validated);
        return redirect()->route('profile.index',['user'=>$user->id])->with($notification);
    }


    public function update_pass(Request $request,User $user){
        $validated=$request->validate(
            [
                'current_password'=>'required',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required',
            ],
            [
                'required'=>'請輸入:attribute',
            ]
        );

        //原本Hash密碼值
        $hash_password=$user->password;
        if(Hash::check($request->current_password,$hash_password)){
            $new_password=Hash::make($request->password);
            $user->update(['password'=>$new_password]);
            Auth::logout();
            return redirect()->route('login');
        }else{
            return redirect()->back()->withErrors(['current_password'=>'原密碼不正確，請重新確認']);;
        }
    }
}
