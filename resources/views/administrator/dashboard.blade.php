@extends('layouts.app')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-home"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    @if (Auth::check())
        {{ Auth::user()->username }}
    @endif
@endsection
@section('halaman')
    Administrator
@endsection
@section('content-title')
    Dashboard
    <small>Education Priority</small>
@endsection
@section('page')
    <li><a href="#"><i class="fa fa-home"></i> Education Priority</a></li>
    <li class="active">Dashboard</li>
@endsection
@section('sidebar-menu')
    @include('administrator/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::user()->full_name }} </span>
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}" class="btn btn-danger"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
@endsection
@push('styles')
    <style>
        #chartdiv {
            width: 90%;
            height: 500px;
        }
    </style>
    <style>
        .preloader {    position: fixed;    top: 0;    left: 0;    right: 0;    bottom: 0;    background-color: #ffffff;    z-index: 99999;    height: 100%;    width: 100%;    overflow: hidden !important;}.do-loader{    width: 200px;    height: 200px;    position: absolute;    left: 50%;    top: 50%;    margin: 0 auto;    -webkit-border-radius: 100%;       -moz-border-radius: 100%;         -o-border-radius: 100%;            border-radius: 100%;    background-image: url({{ asset('assets/images/logo.png') }});    background-size: 80% !important;    background-repeat: no-repeat;    background-position: center;    -webkit-background-size: cover;            background-size: cover;    -webkit-transform: translate(-50%,-50%);       -moz-transform: translate(-50%,-50%);        -ms-transform: translate(-50%,-50%);         -o-transform: translate(-50%,-50%);            transform: translate(-50%,-50%);}.do-loader:before {    content: "";    display: block;    position: absolute;    left: -6px;    top: -6px;    height: calc(100% + 12px);    width: calc(100% + 12px);    border-top: 1px solid #07A8D8;    border-left: 1px solid transparent;    border-bottom: 1px solid transparent;    border-right: 1px solid transparent;    border-radius: 100%;    -webkit-animation: spinning 0.750s infinite linear;       -moz-animation: spinning 0.750s infinite linear;         -o-animation: spinning 0.750s infinite linear;            animation: spinning 0.750s infinite linear;}@-webkit-keyframes spinning {   from {-webkit-transform: rotate(0deg);}   to {-webkit-transform: rotate(359deg);}}@-moz-keyframes spinning {   from {-moz-transform: rotate(0deg);}   to {-moz-transform: rotate(359deg);}}@-o-keyframes spinning {   from {-o-transform: rotate(0deg);}   to {-o-transform: rotate(359deg);}}@keyframes spinning {   from {transform: rotate(0deg);}   to {transform: rotate(359deg);}}
    </style>
@endpush
@section('content')
    <div class="callout callout-info">
        <h4>Selamat Datang, <b>{{ Auth::user()->sure_name }}</b></h4>
        <p>
            Education Priority System adalah sistem informasi pendaftaran calon siswa secara online, silahkan lengkapi data anda kemudian upload bukti pembayaran anda
            <br>
            <i><b>Catatan</b>: Untuk keamanan, silahkan keluar setelah selesai menggunakan aplikasi</i>
        </p>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User Terdaftar</span>
                    <span class="info-box-number">{{ $user }} Orang</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sudah Membayar</span>
                    <span class="info-box-number">{{ $membayar }} Orang</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Belum Membayar</span>
                    <span class="info-box-number">{{ $belum_membayar }} Orang</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pembayaran</span>
                    <span class="info-box-number">Rp. {{ number_format($total,2) }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
