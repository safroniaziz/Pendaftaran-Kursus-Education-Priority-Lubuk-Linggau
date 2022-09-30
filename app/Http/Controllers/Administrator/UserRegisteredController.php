<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRegisteredController extends Controller
{
    public function index(){
        $users = User::where('user_role','user')->get();
        return view('administrator/manajemen_user.index',[
            'users' => $users,
        ]);
    }

    public function detail($id){
        $user = User::where('id',$id)->first();
        return view('administrator/manajemen_user.detail',[
            'user' => $user,
        ]);
    }

    public function setNonAktive($id){
        User::where('id',$id)->update([
            'is_active' =>  false,
        ]);
        $notification = array(
            'message' => 'Berhasil, akun user berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('administrator.user')->with($notification);
    }

    public function setAktive($id){
        User::where('id',$id)->update([
            'is_active' =>  true,
        ]);
        $notification = array(
            'message' => 'Berhasil, akun user berhasil diaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('administrator.user')->with($notification);
    }

    public function changePassword(Request $request,$id){
        User::where('id', $id)->update([
            'password' =>   bcrypt($request->password)
        ]);

        $notification = array(
            'message' => 'Berhasil, password user berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('administrator.user')->with($notification);
    }
}
