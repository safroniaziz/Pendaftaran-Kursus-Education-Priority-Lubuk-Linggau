<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserProofController extends Controller
{
    public function index(){
        $setting = Pengaturan::first();
        return view('user/proof.index',[
            'setting' => $setting
        ]);
    }

    public function proofUpdate(Request $request, $id){
        $messages = [
            'required'              => ':attribute harus diisi',
        ];
        $attributes = [
            'proof_of_payment'      =>  'Bukti Pembayaran',
        ];
        $this->validate($request,[
            'proof_of_payment'                 =>  'required|max:1024',
        ],$messages,$attributes);

        $slug = Str::slug(Auth::user()->sure_name);
        $model['proof_of_payment'] = null;

        if ($request->hasFile('proof_of_payment')) {
            $model['proof_of_payment'] = $slug.'-'.'bukti_pembayaran'.'-'.md5(uniqid(rand(), true)).'.'.$request->proof_of_payment->getClientOriginalExtension();
            $request->proof_of_payment->move(public_path('/upload/bukti_pembayaran/'), $model['proof_of_payment']);
        }
        User::where('id',$id)->update([
            'proof_of_payment' => $model['proof_of_payment'],
        ]);
        $notification = array(
            'message' => 'Berhasil, bukti pembayaran berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('user.proof')->with($notification);
    }
}
