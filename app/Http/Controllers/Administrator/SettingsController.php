<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingsController extends Controller
{

    public function index(){
        $setting = Pengaturan::where('id',1)->first();
        return view('administrator/settings.index',compact('setting'));
    }

    public function update(Request $request, $id){
        $attributes = [
            'nama_app'          =>  'Nama Aplikasi',
            'singkatan'         =>  'Singkatan Aplikasi',
            'keterangan_app'    =>  'Deskripsi',
            'biaya_pendaftaran' =>  'Biaya Pendaftaran ',
            'biaya_keseluruhan'   =>  'Biaya Kursus ',
            'bank'              =>  'Bank Name ',
            'norek'             =>  'Bank Account Number',
        ];
        $this->validate($request, [
            'logo'   =>  'mimes:jpg,jpeg,png|max:500',
            'nama_app'  =>  'required',
            'singkatan' =>  'required',
            'keterangan_app'    =>  'required',
            'biaya_pendaftaran'   =>  'required',
            'biaya_keseluruhan' =>  'required',
            'bank' =>  'required',
            'norek' =>  'required',
        ],$attributes);

        $logo = Pengaturan::find($id);
        $model = $request->all();
        if ($request->hasFile('logo')){
            if (!$logo->logo == NULL){
                unlink(public_path('/upload/logo_aplikasi/'.$logo->logo));
            }
            $model['logo'] = Auth::user()->id.uniqid().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('/upload/logo_aplikasi/'), $model['logo']);
        }

        if ($request->hasFile('logo')) {
            Pengaturan::where('id',$id)->update([
                'nama_app'  => $request->nama_app,
                'singkatan'  => $request->singkatan,
                'keterangan_app'  => $request->keterangan_app,
                'biaya_pendaftaran'  => $request->biaya_pendaftaran,
                'biaya_keseluruhan'  => $request->biaya_keseluruhan,
                'bank'  => $request->bank,
                'norek'  => $request->norek,
                'logo_app'          => $model['logo'],
            ]);
        }else {
            Pengaturan::where('id',$id)->update([
                'nama_app'  => $request->nama_app,
                'singkatan'  => $request->singkatan,
                'keterangan_app'  => $request->keterangan_app,
                'biaya_pendaftaran'  => $request->biaya_pendaftaran,
                'biaya_keseluruhan'  => $request->biaya_keseluruhan,
                'bank'  => $request->bank,
                'norek'  => $request->norek,
            ]);
        }

        $notification = array(
            'message' => 'Application settings successfully updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('administrator.settings')->with($notification);
    }
}
