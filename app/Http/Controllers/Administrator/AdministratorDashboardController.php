<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorDashboardController extends Controller
{
    public function dashboard(){
        $user       = Count(User::all());
        $membayar   = Count(User::where('proof_of_payment','!=',null)->where('proof_of_payment','!=',"")->get());
        $belum_membayar   = Count(User::where('proof_of_payment',null)->orWhere('proof_of_payment',"")->get());
        $biaya_pendaftaran = Pengaturan::select('biaya_pendaftaran')->first();
        $total = $membayar * $biaya_pendaftaran->biaya_pendaftaran;
        return view('administrator.dashboard',[
            'user'              => $user,
            'membayar'          => $membayar,
            'belum_membayar'    => $belum_membayar,
            'total'    => $total,
        ]);
    }
}
