<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }

    public function profileUpdate(Request $request,$id){
        $messages = [
            'required'              => ':attribute harus diisi',
            'dimensions'              => ' Dimensi :attribute tidak memenuhi standar tinggi dan lebar',
        ];
        $attributes = [
            'first_name'            =>  'Nama Awal',
            'sure_name'             =>  'Nama Lengkap',
            'email'                 =>  'Email',
            'gender'                =>  'Jenis Kelamin',
            'place_of_birth'        =>  'Tempat Lahir',
            'date_of_birth'         =>  'Tanggal Lahir',
            'address'               =>  'Alamat',
            'graduation_year'       =>  'Tahun Lulus',
            'phone_number'          =>  'Nomor Telephone',
            'parent_phone_number'   =>  'Nomor Telephone Orang Tua',
            'formal_education'      =>  'Sekolah Formal (SMA/Kuliah)',
            'study_program'         =>  'Program Studi',
            'class'                 =>  'Kelas',
            'semester'              =>  'Semester',
            'learning_program'      =>  'Program Pembalajaran',
            'photo'                 =>  'Foto',
        ];
        $this->validate($request,[
            'first_name'            =>  'required',
            'sure_name'             =>  'required',
            'email'                 =>  'required',
            'gender'                =>  'required',
            'place_of_birth'        =>  'required',
            'date_of_birth'         =>  'required',
            'address'               =>  'required',
            'graduation_year'       =>  'required',
            'phone_number'          =>  'required',
            'parent_phone_number'   =>  'required',
            'formal_education'      =>  'required',
            'study_program'         =>  'required',
            'class'                 =>  'required',
            'semester'              =>  'required',
            'learning_program'      =>  'required',
            'photo'                 =>  'image|mimes:jpeg,jpg,png|max:1000|dimensions:height=660,width=450',
            // 'proof_of_payment'      =>  'required|mimes:pdf|max:1024',
        ],$messages,$attributes);

        $array = [
            'first_name'            =>  $request->first_name,
            'sure_name'             =>  $request->sure_name,
            'email'                 =>  $request->email,
            'gender'                =>  $request->gender,
            'place_of_birth'        =>  $request->place_of_birth,
            'date_of_birth'         =>  $request->date_of_birth,
            'address'               =>  $request->address,
            'graduation_year'       =>  $request->graduation_year,
            'phone_number'          =>  $request->phone_number,
            'parent_phone_number'   =>  $request->parent_phone_number,
            'formal_education'      =>  $request->formal_education,
            'study_program'         =>  $request->study_program,
            'class'                 =>  $request->class,
            'semester'              =>  $request->semester,
            'learning_program'      =>  $request->learning_program,
        ];

        $slug = Str::slug(Auth::user()->sure_name);
        $model['photo'] = null;
        // $model['proof_of_payment'] = null;

        if ($request->hasFile('photo')) {
            $model['photo'] = $slug.'-'.'pas_foto'.'-'.md5(uniqid(rand(), true)).'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/pas_foto/'), $model['photo']);
            $array['photo'  ]  =  $model['photo'];
        }

        // if ($request->hasFile('proof_of_payment')) {
        //     $model['proof_of_payment'] = $slug.'-'.'bukti_pembayaran'.'-'.md5(uniqid(rand(), true)).'.'.$request->proof_of_payment->getClientOriginalExtension();
        //     $request->proof_of_payment->move(public_path('/upload/bukti_pembayaran/'), $model['proof_of_payment']);
        //     $array['proof_of_payment'  ]  =  $model['proof_of_payment'];
        // }

        User::where('id',$id)->update($array);
        $notification = array(
            'message' => 'Berhasil, formulir kelengkapan data berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('user.dashboard')->with($notification);
    }
}
