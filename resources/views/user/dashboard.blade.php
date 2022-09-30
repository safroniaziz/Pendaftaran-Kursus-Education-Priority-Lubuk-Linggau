@extends('layouts.app')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-home"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    @if (Auth::check())
        {{ Auth::user()->sure_name }}
    @endif
@endsection
@section('halaman')
    User
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
    @include('user/sidebar')
@endsection
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
        <div class="col-md-3 sm-6">
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;Profil Saya</h3>
                </div>
                <div class="box-body box-profile">
                    @if (Auth::user()->photo == null || Auth::user()->photo == "")
                        <img class="profile-user-img img-responsive " src="https://cdn-icons-png.flaticon.com/128/1177/1177568.png" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-responsive" src="{{ asset('upload/pas_foto/'.Auth::user()->photo) }}" alt="User profile picture">
                    @endif
                    <h3 style="font-size:16px !important;" class="profile-username text-center">{{ Auth::user()->sure_name }}</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <b>Nama Awal</b> <a class="pull-right">{{ Auth::user()->first_name }}</a>
                        </li>
                        <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
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
                                                <input type="hidden" name="id" id="id" value={{ Auth::user()->id}}>
                                                <input type="password" name="password_ubah" id="password_ubah" class="form-control password">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Konfirmasi Password</label>
                                            <input type="password" name="password_ubah2" id="password_ubah2" class="form-control password2">
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
                    <div class="col-md-12">
                        <div class="callout callout-success">
                            <h4>Informasi Penting</b></h4>
                            <p>
                                Silahkan lengkapi data anda untuk dapat mencetak surat penawaran
                            </p>
                        </div>
                    </div>
                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal" action="{{ route('user.profile_update',[Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }} {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="first_name" class="col-sm-2 control-label"@if (Auth::user()->email == null || Auth::user()->email =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Nama Awal</label>
                                <div class="col-sm-10">
                                    <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" id="first_name"@if (Auth::user()->first_name == null || Auth::user()->first_name =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                    <div>
                                        @if ($errors->has('first_name'))
                                            <small class="form-text text-danger">{{ $errors->first('first_name') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sure_name" class="col-sm-2 control-label"@if (Auth::user()->email == null || Auth::user()->email =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Nama Sebenarnya</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sure_name" class="form-control" value="{{ Auth::user()->sure_name }}"@if (Auth::user()->sure_name == null || Auth::user()->sure_name =="")
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
                                <label for="email" class="col-sm-2 control-label" @if (Auth::user()->email == null || Auth::user()->email =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Email</label>

                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" id="email"@if (Auth::user()->email == null || Auth::user()->email =="")
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
                                <label for="inputExperience" class="col-sm-2 control-label" @if (Auth::user()->gender == null || Auth::user()->gender =="")
                                            style="color:#dd4b39 !important;"
                                    @endif>Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="gender" class="form-control" id="" @if (Auth::user()->gender == null || Auth::user()->gender =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                        <option disabled selected>-- pilih jenis kelamin --</option>
                                        <option value="M"
                                            @if (Auth::user()->gender == "M")
                                                selected
                                            @endif
                                        >Laki-Laki</option>
                                        <option value="F"
                                            @if (Auth::user()->gender == "F")
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
                                <label for="place_of_birth" class="col-sm-2 control-label" @if (Auth::user()->place_of_birth == null || Auth::user()->place_of_birth =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Tempat Lahir</label>

                                <div class="col-sm-10">
                                    <input type="text" name="place_of_birth" value="{{ Auth::user()->place_of_birth }}" class="form-control" id="email" @if (Auth::user()->place_of_birth == null || Auth::user()->place_of_birth =="")
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
                                <label for="date_of_birth" class="col-sm-2 control-label" @if (Auth::user()->date_of_birth == null || Auth::user()->date_of_birth =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Tanggal Lahir</label>

                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" value="{{ Auth::user()->date_of_birth }}" name="date_of_birth" id="date_of_birth" class="form-control pull-right"@if (Auth::user()->date_of_birth == null || Auth::user()->date_of_birth =="")
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
                                <label for="address" class="col-sm-2 control-label" @if (Auth::user()->address == null || Auth::user()->address =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Alamat</label>

                                <div class="col-sm-10">
                                    <textarea name="address" id="address" cols="30" rows="3" class="form-control" @if (Auth::user()->address == null || Auth::user()->address =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>{{ Auth::user()->address }}</textarea>
                                    <div>
                                        @if ($errors->has('address'))
                                            <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="graduation_year" class="col-sm-2 control-label" @if (Auth::user()->graduation_year == null || Auth::user()->graduation_year =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Tahun Lulus</label>

                                <div class="col-sm-10">
                                    <input type="text" name="graduation_year" value="{{ Auth::user()->graduation_year }}" class="form-control" id="email" @if (Auth::user()->graduation_year == null || Auth::user()->graduation_year =="")
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
                                <label for="phone_number" class="col-sm-2 control-label" @if (Auth::user()->phone_number == null || Auth::user()->phone_number =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Telephone</label>

                                <div class="col-sm-10">
                                    <input type="number" name="phone_number" value="{{ Auth::user()->phone_number }}" class="form-control" id="email" @if (Auth::user()->phone_number == null || Auth::user()->phone_number =="")
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
                                <label for="parent_phone_number" class="col-sm-2 control-label" @if (Auth::user()->parent_phone_number == null || Auth::user()->parent_phone_number =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Telephone Orang Tua</label>

                                <div class="col-sm-10">
                                    <input type="number" name="parent_phone_number" value="{{ Auth::user()->parent_phone_number }}" class="form-control" id="email" @if (Auth::user()->parent_phone_number == null || Auth::user()->parent_phone_number =="")
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
                                <label for="formal_education" class="col-sm-2 control-label" @if (Auth::user()->formal_education == null || Auth::user()->formal_education =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Pendidikan Formal</label>

                                <div class="col-sm-10">
                                    <input type="text" name="formal_education" value="{{ Auth::user()->formal_education }}" class="form-control" id="email" @if (Auth::user()->formal_education == null || Auth::user()->formal_education =="")
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
                                <label for="study_program" class="col-sm-2 control-label" @if (Auth::user()->study_program == null || Auth::user()->study_program =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Program Studi</label>

                                <div class="col-sm-10">
                                    <input type="text" name="study_program" value="{{ Auth::user()->study_program }}" class="form-control" id="email" @if (Auth::user()->study_program == null || Auth::user()->study_program =="")
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
                                <label for="class" class="col-sm-2 control-label" @if (Auth::user()->class == null || Auth::user()->class =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Kelas</label>

                                <div class="col-sm-10">
                                    <input type="text" name="class" value="{{ Auth::user()->class }}" class="form-control" id="email" @if (Auth::user()->class == null || Auth::user()->class =="")
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
                                <label for="semester" class="col-sm-2 control-label" @if (Auth::user()->semester == null || Auth::user()->semester =="")
                                        style="color:#dd4b39 !important;"
                                @endif>Semester</label>

                                <div class="col-sm-10">
                                    <input type="text" name="semester" value="{{ Auth::user()->semester }}" class="form-control" id="email" @if (Auth::user()->semester == null || Auth::user()->semester =="")
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
                                <label for="inputExperience" class="col-sm-2 control-label" @if (Auth::user()->learning_program == null || Auth::user()->learning_program =="")
                                            style="color:#dd4b39 !important;"
                                    @endif>Program Belajar</label>
                                <div class="col-sm-10">
                                    <select name="learning_program" class="form-control" id="" @if (Auth::user()->learning_program == null || Auth::user()->learning_program =="")
                                            style="border-color:#dd4b39 !important;"
                                    @endif>
                                        <option disabled selected>-- pilih program belajar --</option>
                                        <option value="akpol"
                                            @if (Auth::user()->learning_program == "akpol")
                                                selected
                                            @endif
                                        >Seleksi Calon Taruna Akademi Polisi (AKPOL)</option>
                                        <option value="akmil"
                                            @if (Auth::user()->learning_program == "akmil")
                                                selected
                                            @endif
                                        >Seleksi Calon Taruna Akademi Militer (AKMIL)</option>
                                        <option value="bintara"
                                            @if (Auth::user()->learning_program == "bintara")
                                                selected
                                            @endif
                                        >Seleksi Calon Bintara Polisi/TNI</option>
                                        <option value="tamtama"
                                            @if (Auth::user()->learning_program == "tamtama")
                                                selected
                                            @endif
                                        >Seleksi Calon Tamtama Polisi/TNI</option>
                                        <option value="eng_sma"
                                            @if (Auth::user()->learning_program == "eng_sma")
                                                selected
                                            @endif
                                        >Academic English (Bahasa Inggris SMA)</option>
                                        <option value="toefl_ielts"
                                            @if (Auth::user()->learning_program == "toefl_ielts")
                                                selected
                                            @endif
                                        >TOEFL/IELTS</option>
                                        <option value="utbk"
                                            @if (Auth::user()->learning_program == "utbk")
                                                selected
                                            @endif
                                        >Ujian Tulis Berbasis Komputer (UTBK)</option>
                                        <option value="cpns"
                                            @if (Auth::user()->learning_program == "cpns")
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

                            <div class="form-group">
                                <label for="photo" class="col-sm-2 control-label">photo</label>
                                <div class="col-sm-10">
                                    <input type="file" name="photo" class="form-control">
                                    <div>
                                        @if ($errors->has('photo'))
                                            <small class="form-text text-danger">{{ $errors->first('photo') }}</small>
                                        @else
                                            <small class="form-text text-danger">Input pas foto dengan dimensi tinggi 660 piksel, dan lebar 450 piksel</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label for="proof_of_payment" class="col-sm-2 control-label">Bukti Pembayaran</label>
                                <div class="col-sm-10">
                                    <input type="file" name="proof_of_payment" class="form-control">
                                    <div>
                                        @if ($errors->has('proof_of_payment'))
                                            <small class="form-text text-danger">{{ $errors->first('proof_of_payment') }}</small>
                                        @else
                                            <small class="form-text text-danger">Input bukti pembayaran (pdf maksimal 1mb)</small>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i>&nbsp;Ulangi</button>
                                        <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp;Simpan</button>
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
