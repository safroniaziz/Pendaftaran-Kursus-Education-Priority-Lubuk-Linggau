@extends('layouts.app')
@section('location','User Terdaftar')
@section('location2')
    <i class="fa fa-users"></i>&nbsp;User Terdaftar
@endsection
@section('user-login')
    @if (Auth::check())
        {{ $user->username }}
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
          <span class="hidden-xs">{{ $user->firstName }} {{ $user->lastName }}</span>
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
        <div class="col-md-3 sm-6">
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;Profil User</h3>
                </div>
                <div class="box-body box-profile">
                    @if ($user->photo == null || $user->photo == "")
                        <img class="profile-user-img img-responsive " src="https://cdn-icons-png.flaticon.com/128/1177/1177568.png" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-responsive" src="{{ asset('upload/pas_foto/'.$user->photo) }}" alt="User profile picture">
                    @endif
                    <h3 style="font-size:16px !important;" class="profile-username text-center">{{ $user->sure_name }}</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <b>Nama Awal</b> <a class="pull-right">{{ $user->first_name }}</a>
                        </li>
                        <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                        </li>
                    </ul>
                    <button type="button" class="btn btn-primary btn-sm btn-flat btn-block" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-key"></i>&nbsp;Ubah Password
                    </button>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action=" {{ route('user.change_password') }} " method="POST">
                            {{ csrf_field() }} {{ method_field('PATCH') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Ubah Password
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </h5>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                                <label for="">Masukan Password</label>
                                                <input type="hidden" disabled name="id" id="id" value={{ $user->id}}>
                                                <input type="password" disabled name="password_ubah" id="password_ubah" class="form-control password">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Konfirmasi Password</label>
                                            <input type="password" disabled name="password_ubah2" id="password_ubah2" class="form-control password2">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <a class="password_ubah_sama" style="color: green; font-size:12px; font-style:italic; display:none;"><i class="fa fa-check-circle"></i>&nbsp;Password Sama!!</a>
                                            <a class="password_ubah_tidak_sama" style="color: red; font-size:12px; font-style:italic; display:none;"><i class="fa fa-close"></i>&nbsp;Password Tidak Sama!!</a>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                                <button type="submit" class="btn btn-primary btn-sm" id="btn-submit-ubah" disable><i class="fa fa-check-circle"></i>&nbsp; Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab"><i class="fa fa-wpforms"></i>&nbsp;Formulir Kelengkapan Data</a></li>
                </ul>
                <div class="tab-content">
                    @if ($user->learning_program != null || $user->learning_program != "")
                        @if ($user->proof_of_payment != null || $user->proof_of_payment != "")
                            <div class="callout callout-success">
                                <h4>Informasi</h4>
                                <p>
                                    {{ $user->sure_name }} sudah melengkapi data dan mengirimkan bukti pembayaran
                                </p>
                            </div>
                        @elseif ($user->proof_of_payment == null || $user->proof_of_payment == "")
                            <div class="callout callout-warning">
                                <h4>Informasi</h4>
                                <p>
                                    {{ $user->sure_name }} sudah melengkapi data, tapi belum mengirimkan bukti pembayaran
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="callout callout-danger">
                            <h4>Informasi</h4>
                            <p>
                                {{ $user->sure_name }} belum melengkapi data, dan juga belum mengirimkan bukti pembayaran
                            </p>
                        </div>
                    @endif

                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal" action="{{ route('user.profile_update',[$user->id]) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }} {{ method_field('PATCH') }}

                            <div class="form-group">
                                <label for="first_name" class="col-sm-2 control-label"@if ($user->email == null || $user->email =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Nama Awal</label>
                                <div class="col-sm-10">
                                    <a class="btn btn-primary btn-sm" href="{{ asset('upload/bukti_pembayaran/'.$user->proof_of_payment) }}" download="{{ $user->proof_of_payment }}"><i class="fa fa-file-pdf-o"></i>&nbsp; Download</a>

                                    <div>
                                        @if ($errors->has('first_name'))
                                            <small class="form-text text-danger">{{ $errors->first('first_name') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sure_name" class="col-sm-2 control-label"@if ($user->email == null || $user->email =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Nama Sebenarnya</label>
                                <div class="col-sm-10">
                                    <input type="text" disabled name="sure_name" class="form-control" value="{{ $user->sure_name }}"@if ($user->sure_name == null || $user->sure_name =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('sure_name'))
                                            <small class="form-text text-danger">{{ $errors->first('sure_name') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label" @if ($user->email == null || $user->email =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Email</label>

                                <div class="col-sm-10">
                                    <input type="email" disabled name="email" value="{{ $user->email }}" class="form-control" id="email"@if ($user->email == null || $user->email =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('email'))
                                            <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label" @if ($user->gender == null || $user->gender =="")
                                            style="color:#dd4b39 !important;"
                                    @endif>Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select disabled name="gender" class="form-control" id="" @if ($user->gender == null || $user->gender =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                        <option disabled selected>-- pilih jenis kelamin --</option>
                                        <option value="M"
                                            @if ($user->gender == "M")
                                                selected
                                            @endif
                                        >Laki-Laki</option>
                                        <option value="F"
                                            @if ($user->gender == "F")
                                                selected
                                            @endif
                                        >Perempuan</option>
                                    </select>
                                    <div>
                                        @if ($errors->has('gender'))
                                            <small class="form-text text-danger">{{ $errors->first('gender') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="place_of_birth" class="col-sm-2 control-label" @if ($user->place_of_birth == null || $user->place_of_birth =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Tempat Lahir</label>

                                <div class="col-sm-10">
                                    <input type="text" disabled name="place_of_birth" value="{{ $user->place_of_birth }}" class="form-control" id="email" @if ($user->place_of_birth == null || $user->place_of_birth =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('place_of_birth'))
                                            <small class="form-text text-danger">{{ $errors->first('place_of_birth') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth" class="col-sm-2 control-label" @if ($user->date_of_birth == null || $user->date_of_birth =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Tanggal Lahir</label>

                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" disabled value="{{ $user->date_of_birth }}" name="date_of_birth" id="date_of_birth" class="form-control pull-right"@if ($user->date_of_birth == null || $user->date_of_birth =="")
                                                style="border-color:#dd4b39 !important;"
                                        @endif>
                                    </div>
                                    <div>
                                        @if ($errors->has('date_of_birth'))
                                            <small class="form-text text-danger">{{ $errors->first('date_of_birth') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label" @if ($user->address == null || $user->address =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Alamat</label>

                                <div class="col-sm-10">
                                    <textarea disabled name="address" id="address" cols="30" rows="3" class="form-control" @if ($user->address == null || $user->address =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>{{ $user->address }}</textarea>
                                    <div>
                                        @if ($errors->has('address'))
                                            <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="graduation_year" class="col-sm-2 control-label" @if ($user->graduation_year == null || $user->graduation_year =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Tahun Lulus</label>

                                <div class="col-sm-10">
                                    <input type="text" disabled name="graduation_year" value="{{ $user->graduation_year }}" class="form-control" id="email" @if ($user->graduation_year == null || $user->graduation_year =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('graduation_year'))
                                            <small class="form-text text-danger">{{ $errors->first('graduation_year') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone_number" class="col-sm-2 control-label" @if ($user->phone_number == null || $user->phone_number =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Telephone</label>

                                <div class="col-sm-10">
                                    <input type="number" disabled name="phone_number" value="{{ $user->phone_number }}" class="form-control" id="email" @if ($user->phone_number == null || $user->phone_number =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('phone_number'))
                                            <small class="form-text text-danger">{{ $errors->first('phone_number') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="parent_phone_number" class="col-sm-2 control-label" @if ($user->parent_phone_number == null || $user->parent_phone_number =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Telephone Orang Tua</label>

                                <div class="col-sm-10">
                                    <input type="number" disabled name="parent_phone_number" value="{{ $user->parent_phone_number }}" class="form-control" id="email" @if ($user->parent_phone_number == null || $user->parent_phone_number =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('parent_phone_number'))
                                            <small class="form-text text-danger">{{ $errors->first('parent_phone_number') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="formal_education" class="col-sm-2 control-label" @if ($user->formal_education == null || $user->formal_education =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Pendidikan Formal</label>

                                <div class="col-sm-10">
                                    <input type="text" disabled name="formal_education" value="{{ $user->formal_education }}" class="form-control" id="email" @if ($user->formal_education == null || $user->formal_education =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('formal_education'))
                                            <small class="form-text text-danger">{{ $errors->first('formal_education') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="study_program" class="col-sm-2 control-label" @if ($user->study_program == null || $user->study_program =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Program Studi</label>

                                <div class="col-sm-10">
                                    <input type="text" disabled name="study_program" value="{{ $user->study_program }}" class="form-control" id="email" @if ($user->study_program == null || $user->study_program =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('study_program'))
                                            <small class="form-text text-danger">{{ $errors->first('study_program') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="class" class="col-sm-2 control-label" @if ($user->class == null || $user->class =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Kelas</label>

                                <div class="col-sm-10">
                                    <input type="text" disabled name="class" value="{{ $user->class }}" class="form-control" id="email" @if ($user->class == null || $user->class =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('class'))
                                            <small class="form-text text-danger">{{ $errors->first('class') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="semester" class="col-sm-2 control-label" @if ($user->semester == null || $user->semester =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Semester</label>

                                <div class="col-sm-10">
                                    <input type="text" disabled name="semester" value="{{ $user->semester }}" class="form-control" id="email" @if ($user->semester == null || $user->semester =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('semester'))
                                            <small class="form-text text-danger">{{ $errors->first('semester') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label" @if ($user->learning_program == null || $user->learning_program =="")
                                            style="color:#dd4b39 !important;"
                                    @endif>Program Belajar</label>
                                <div class="col-sm-10">
                                    <select disabled name="learning_program" class="form-control" id="" @if ($user->learning_program == null || $user->learning_program =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                        <option disabled selected>-- pilih program belajar --</option>
                                        <option value="akpol"
                                            @if ($user->learning_program == "akpol")
                                                selected
                                            @endif
                                        >Seleksi Calon Taruna Akademi Polisi (AKPOL)</option>
                                        <option value="akmil"
                                            @if ($user->learning_program == "akmil")
                                                selected
                                            @endif
                                        >Seleksi Calon Taruna Akademi Militer (AKMIL)</option>
                                        <option value="bintara"
                                            @if ($user->learning_program == "bintara")
                                                selected
                                            @endif
                                        >Seleksi Calon Bintara Polisi/TNI</option>
                                        <option value="tamtama"
                                            @if ($user->learning_program == "tamtama")
                                                selected
                                            @endif
                                        >Seleksi Calon Tamtama Polisi/TNI</option>
                                        <option value="eng_sma"
                                            @if ($user->learning_program == "eng_sma")
                                                selected
                                            @endif
                                        >Academic English (Bahasa Inggris SMA)</option>
                                        <option value="toefl_ielts"
                                            @if ($user->learning_program == "toefl_ielts")
                                                selected
                                            @endif
                                        >TOEFL/IELTS</option>
                                        <option value="utbk"
                                            @if ($user->learning_program == "utbk")
                                                selected
                                            @endif
                                        >Ujian Tulis Berbasis Komputer (UTBK)</option>
                                        <option value="cpns"
                                            @if ($user->learning_program == "cpns")
                                                selected
                                            @endif
                                        >Seleksi Calon Pegawai Negeri Sipil (CPNS)</option>
                                    </select>
                                    <div>
                                        @if ($errors->has('learning_program'))
                                            <small class="form-text text-danger">{{ $errors->first('learning_program') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );

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

        $('#date_of_birth').datepicker({
            format: 'yyyy/mm/dd', autoclose: true
        })
    </script>
@endpush
