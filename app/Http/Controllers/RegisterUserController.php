<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function registerUser(Request $request){
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        $attributes = [
            'first_name'    =>  'Nama Awal',
            'sure_name'     =>  'Nama Sebenarnya ',
            'email'         =>  'Email ',
            'password'      =>  'Password ',

        ];
        $this->validate($request, [
            'first_name'    =>  'required',
            'sure_name'     =>  'required',
            'email'         =>  'required',
            'password'      =>  'required',
        ],$messages,$attributes);

        User::create([
            'first_name'        =>  $request->first_name,
            'sure_name'         =>  strtoupper($request->sure_name),
            'email'             =>  $request->email,
            'password'          =>  bcrypt($request->password),
            'is_active'         =>  1,
            'user_role'         =>  'user',
        ]);

        return redirect()->route('login')->with(['success'  => 'Your registration account has been successfully registered']);
    }
}
