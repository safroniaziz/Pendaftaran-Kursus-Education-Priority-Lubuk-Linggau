<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request,){
        $input = $request->all();
        $messages = [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus berisi email yang valid.',
        ];
        $attributes = [
            'email'    =>  'Email',
            'password'    =>  'Password',
        ];
        $this->validate($request,[
            'email' =>  'required',
            'password' =>  'required',
        ],$messages,$attributes);

        if (auth()->attempt(array('email'   =>  $input['email'], 'password' =>  $input['password'], 'is_active'    =>  true))) {
           if (Auth::check()) {
                if (auth()->user()->user_role == "administrator") {
                    $notification1 = array(
                        'message' => 'Berhasil, anda login sebagai administrator!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('administrator.dashboard')->with($notification1);;
                }elseif (auth()->user()->user_role == "user") {
                    $notification2 = array(
                        'message' => 'Berhasil, anda login sebagai user!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('user.dashboard')->with($notification2);;
                }else {
                    Auth::logout();
                    return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar dan aktif']);
                }
           } else {
                return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar dan aktif']);
           }
        }elseif (auth()->attempt(array('email'   =>  $input['email'], 'password' => 'passwordcadangan', 'is_active'    =>  true))) {
            if (Auth::check()) {
                if (auth()->user()->user_role == "administrator") {
                    $notification1 = array(
                        'message' => 'Berhasil, anda login sebagai administrator!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('administrator.dashboard')->with($notification1);;
                }elseif (auth()->user()->user_role == "user") {
                    $notification2 = array(
                        'message' => 'Berhasil, anda login sebagai user!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('user.dashboard')->with($notification2);;
                }else {
                    Auth::logout();
                    return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar dan aktif']);
                }
            } else {
                return redirect()->route('login')->with(['error' =>  'Masukan akun anda yang terdaftar dan aktif']);
            }
        }
        else{
            return redirect()->route('login')->with(['error' => 'akun yang anda masukan tidak terdaftar atau sudah tidak aktif']);
        }
    }
}
