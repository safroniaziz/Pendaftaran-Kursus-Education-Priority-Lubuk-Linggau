@extends('layouts.app')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-home"></i>&nbsp;SETTINGS
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
    SETTINGS
    <small>{{ !empty($setting) ? $setting->nama_app : '' }}</small>
@endsection
@section('page')
    <li><a href="#"><i class="fa fa-home"></i> {{ !empty($setting) ? $setting->nama_app : '' }}</a></li>
    <li class="active">Settings</li>
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
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-history"></i>&nbsp;Pengaturan Aplikasi</h3>
                </div>
                <div class="row">
                    <form role="form" action="{{ route('administrator.settings.update',[!empty($setting) ? $setting->id : '']) }}" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            {{ csrf_field() }} {{ method_field('PATCH') }}
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nama Aplikasi</label>
                                <input type="text" name="nama_app" value="{{ !empty($setting) ? $setting->nama_app : '' }}" class="form-control">
                                <div>
                                    @if ($errors->has('nama_app'))
                                        <small class="form-text text-danger">{{ $errors->first('nama_app') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nama Pendek Aplikasi</label>
                                <input type="text" name="singkatan" value="{{ !empty($setting) ? $setting->singkatan : '' }}" class="form-control">
                                <div>
                                    @if ($errors->has('singkatan'))
                                        <small class="form-text text-danger">{{ $errors->first('singkatan') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Deskripsi Aplikasi</label>
                                <input type="text" name="keterangan_app" value="{{ !empty($setting) ? $setting->keterangan_app : '' }}" class="form-control">
                                <div>
                                    @if ($errors->has('keterangan_app'))
                                        <small class="form-text text-danger">{{ $errors->first('keterangan_app') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Biaya Pendaftaran</label>
                                <input type="text" name="biaya_pendaftaran" value="{{ !empty($setting) ? $setting->biaya_pendaftaran : '' }}" class="form-control">
                                <div>
                                    @if ($errors->has('biaya_pendaftaran'))
                                        <small class="form-text text-danger">{{ $errors->first('biaya_pendaftaran') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Biaya Kursus</label>
                                <input type="text" name="biaya_keseluruhan" value="{{ !empty($setting) ? $setting->biaya_keseluruhan : '' }}" class="form-control">
                                <div>
                                    @if ($errors->has('biaya_keseluruhan'))
                                        <small class="form-text text-danger">{{ $errors->first('biaya_keseluruhan') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nama Bank Tujuan</label>
                                <input type="text" name="bank" value="{{ !empty($setting) ? $setting->bank : '' }}" class="form-control">
                                <div>
                                    @if ($errors->has('bank'))
                                        <small class="form-text text-danger">{{ $errors->first('bank') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nomor Rekening</label>
                                <input type="text" name="norek" value="{{ !empty($setting) ? $setting->norek : '' }}" class="form-control">
                                <div>
                                    @if ($errors->has('norek'))
                                        <small class="form-text text-danger">{{ $errors->first('norek') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Logo Aplikasi</label>
                                <input type="file" name="logo" id="exampleInputFile" class="form-control">
                                <div>
                                    @if ($errors->has('logo'))
                                        <small class="form-text text-danger">{{ $errors->first('logo') }}</small>
                                    @endif
                                </div>
                            </div>

                            @if (!empty($setting))
                                @if ($setting->logo_app == null || $setting->logo_app == "")
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Application Logo</label>
                                        <img src="{{ asset('assets/images/logo.png') }}" width="100" class="img-responsive"alt="">
                                    </div>
                                @else
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Application Logo</label>
                                        <img src="{{ asset('upload/aplication_logo/'.$setting->logo_app) }}" width="100" class="img-responsive"alt="">
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="box-footer ">
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp; Simpan Pengaturan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

