@extends('layouts.app')
@section('location','User Terdaftar')
@section('location2')
    <i class="fa fa-users"></i>&nbsp;User Terdaftar
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
          <span class="hidden-xs">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
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
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users"></i>&nbsp;User Terdaftar</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Berhasil :</strong>{{ $message }}
                            </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Gagal :</strong>{{ $message }}
                                </div>
                                @else
                        @endif
                    </div>
                    <div class="col-md-12 table-responsive">
                        <div class="callout callout-info">
                            <h4>Informasi</h4>
                            <p>
                                User berwarna merah belum mengirimkan bukti pembayaran, sedangkan yang berwarna putih sudah mengirimkan bukti pembayaran
                            </p>
                        </div>
                        <table class="table table-striped table-bordered" id="table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Nomor Hp</th>
                                    <th>Program Belajar</th>
                                    <th>Akun Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr
                                        @if ($user->proof_of_payment == null || $user->proof_of_payment == "")
                                            style="background-color:#fd869e"
                                        @endif
                                    >
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            @if ($user->sure_name == null )
                                                <small style="color:red"><i class="fa fa-minus"></i></small>
                                            @else
                                                {{ $user->sure_name }}
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->gender == "M" )
                                                <small class="label label-info"><i class="fa fa-male"></i>&nbsp; Laki-Laki</small>
                                            @elseif ($user->gender == "F" )
                                                <small class="label label-warning"><i class="fa fa-male"></i>&nbsp; Perempuan</small>
                                            @else
                                                <small class="label label-warning"><i class="fa fa-minus"></i></small>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->place_of_birth == null )
                                                <small style="color:red"><i class="fa fa-minus"></i></small>
                                            @else
                                                {{ $user->place_of_birth }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->date_of_birth == null )
                                                <small style="color:red"><i class="fa fa-minus"></i></small>
                                            @else
                                                {{ $user->date_of_birth->format('Y-m-d') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->phone_number == null )
                                                <small style="color:red"><i class="fa fa-minus"></i></small>
                                            @else
                                                {{ $user->phone_number }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->learning_program == null )
                                                <small style="color:red"><i class="fa fa-minus"></i></small>
                                            @else
                                                {{ $user->learning_program }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->is_active == 1)
                                                <form action="{{ route('administrator.user.set_non_active',[$user->id]) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('PATCH') }}
                                                    <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-thumbs-up"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('administrator.user.set_active',[$user->id]) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('PATCH') }}
                                                    <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-thumbs-down"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('administrator.user.detail',[$user->id]) }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-info-circle"></i>&nbsp; Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal fade" id="modalubahpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action=" {{ route('administrator.user.change_password') }} " method="POST">
                                        {{ csrf_field() }} {{ method_field('PATCH') }}
                                        <div class="modal-header">
                                            <p style="font-size:15px; font-weight:bold;" class="modal-title"><i class="fa fa-key"></i>&nbsp;Form Ubah Password AKun user</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger">
                                                        <i class="fa fa-info-circle"></i>&nbsp;Form ubah password akun user
                                                    </div>
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="form-group">
                                                        <label for="">Masukan Password</label>
                                                        <input type="password" name="password_ubah" id="password_ubah" class="form-control password">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Konfirmasi Password</label>
                                                        <input type="password" name="password_ubah2" id="password_ubah2" class="form-control password2">
                                                    </div>
                                                    <div>
                                                        <a class="password_ubah_sama" style="color: green; font-size:12px; font-style:italic; display:none;"><i class="fa fa-check-circle"></i>&nbsp;Password Sama!!</a>
                                                        <a class="password_ubah_tidak_sama" style="color: red; font-size:12px; font-style:italic; display:none;"><i class="fa fa-close"></i>&nbsp;Password Tidak Sama!!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                                            <button type="submit" class="btn btn-primary btn-sm" id="btn-submit-ubah" disabled><i class="fa fa-check-circle"></i>&nbsp; Ubah Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );

        function ubahPassword(id){
            $('#modalubahpassword').modal('show');
            $('#id_password').val(id);
            $('#id').val(id);
        }

        $(document).ready(function(){
            $("#password, #password2").keyup(function(){
                var password = $("#password").val();
                var ulangi = $("#password2").val();
                if($("#password").val() == $("#password2").val()){
                    $('.password_sama').show(200);
                    $('.password_tidak_sama').hide(200);
                    $('#btn-submit').attr("disabled",false);
                }
                else{
                    $('.password_sama').hide(200);
                    $('.password_tidak_sama').show(200);
                    $('#btn-submit').attr("disabled",true);
                }
            });
        });

        $(document).ready(function(){
            $("#password_ubah, #password_ubah2").keyup(function(){
                var password_ubah = $("#password_ubah").val();
                var ulangi = $("#password_ubah2").val();
                if($("#password_ubah").val() == $("#password_ubah2").val()){
                    $('.password_ubah_sama').show(200);
                    $('.password_ubah_tidak_sama').hide(200);
                    $('#btn-submit-ubah').attr("disabled",false);
                }
                else{
                    $('.password_ubah_sama').hide(200);
                    $('.password_ubah_tidak_sama').show(200);
                    $('#btn-submit-ubah').attr("disabled",true);
                }
            });
        });
    </script>
@endpush
