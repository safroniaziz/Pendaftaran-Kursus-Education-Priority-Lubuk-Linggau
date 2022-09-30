<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Education Priority</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}">
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/login/css/bootstrap.min.css') }}" />
    <style>
        .preloader {    position: fixed;    top: 0;    left: 0;    right: 0;    bottom: 0;    background-color: #ffffff;    z-index: 99999;    height: 100%;    width: 100%;    overflow: hidden !important;}.do-loader{    width: 200px;    height: 200px;    position: absolute;    left: 50%;    top: 50%;    margin: 0 auto;    -webkit-border-radius: 100%;       -moz-border-radius: 100%;         -o-border-radius: 100%;            border-radius: 100%;    background-image: url({{ asset('assets/images/logo.jpg') }});    background-size: 80% !important;    background-repeat: no-repeat;    background-position: center;    -webkit-background-size: cover;            background-size: cover;    -webkit-transform: translate(-50%,-50%);       -moz-transform: translate(-50%,-50%);        -ms-transform: translate(-50%,-50%);         -o-transform: translate(-50%,-50%);            transform: translate(-50%,-50%);}.do-loader:before {    content: "";    display: block;    position: absolute;    left: -6px;    top: -6px;    height: calc(100% + 12px);    width: calc(100% + 12px);    border-top: 1px solid #07A8D8;    border-left: 1px solid transparent;    border-bottom: 1px solid transparent;    border-right: 1px solid transparent;    border-radius: 100%;    -webkit-animation: spinning 0.750s infinite linear;       -moz-animation: spinning 0.750s infinite linear;         -o-animation: spinning 0.750s infinite linear;            animation: spinning 0.750s infinite linear;}@-webkit-keyframes spinning {   from {-webkit-transform: rotate(0deg);}   to {-webkit-transform: rotate(359deg);}}@-moz-keyframes spinning {   from {-moz-transform: rotate(0deg);}   to {-moz-transform: rotate(359deg);}}@-o-keyframes spinning {   from {-o-transform: rotate(0deg);}   to {-o-transform: rotate(359deg);}}@keyframes spinning {   from {transform: rotate(0deg);}   to {transform: rotate(359deg);}}
    </style>
</head>


<body>
    <div class="preloader">
        <div class="do-loader"></div>
    </div>
    <div class="d-flex align-items-center " style="height: 100vh">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 p-5 p-md-0">
                    <img src="{{ asset('assets/images/logo.png') }}" height="100">
                    <div class="mb-4">
                        <h1>Lengkapi Data Anda Untuk Mendaftar</h1>
                    </div>
                    <form method="POST" action="{{ route('register_user') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                id="first_name" placeholder="nama awal" value="{{ old('first_name') }}" autocomplete="first name"
                                autofocus />
                            <div>
                                @if ($errors->has('first_name'))
                                    <small class="form-text text-danger">{{ $errors->first('first_name') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="sure_name" class="form-control @error('sure_name') is-invalid @enderror"
                                id="sure_name" placeholder="nama sebenarnya" value="{{ old('sure_name') }}" autocomplete="sure name"
                                autofocus />
                            <div>
                                @if ($errors->has('sure_name'))
                                    <small class="form-text text-danger">{{ $errors->first('sure_name') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="email" value="{{ old('email') }}" autocomplete="email"
                                autofocus />
                            <div>
                                @if ($errors->has('email'))
                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="password" autocomplete="current-password" />
                            <div>
                                @if ($errors->has('password'))
                                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control password2" name="password_ubah2" id="password_ubah2" placeholder="konfirmasi password">
                            <div>
                                @if ($errors->has('password_ubah2'))
                                    <small class="form-text text-danger">{{ $errors->first('password_ubah2') }}</small>
                                @endif
                            </div>
                            <a class="password_ubah_sama" style="color: green; font-size:12px; font-style:italic; display:none;"><i class="fa fa-check-circle"></i>&nbsp;password sama!!</a>
                            <a class="password_ubah_tidak_sama" style="color: red; font-size:12px; font-style:italic; display:none;"><i class="fa fa-close"></i>&nbsp;password tidak sama!!</a>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1" id="btn-register">
                            Daftar
                        </button>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-3">
                                Sudah memiliki akun? <br> <a href="{{ route('login') }}">Login Disini</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/layout/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(window).on('load', function(){
            // will first fade out the loading animation
            jQuery(".status").fadeOut();
            // will fade out the whole DIV that covers the website.
            jQuery(".preloader").delay(0).fadeOut("slow");
        });

        $(document).ready(function(){
            $("#password, #password2").keyup(function(){
                var password = $("#password").val();
                var ulangi = $("#password2").val();
                if($("#password").val() == $("#password2").val()){
                    $('.password_sama').show(200);
                    $('.password_tidak_sama').hide(200);
                    $('#btn-register').attr("disabled",false);
                }
                else{
                    $('.password_sama').hide(200);
                    $('.password_tidak_sama').show(200);
                    $('#btn-register').attr("disabled",true);
                }
            });
        });

        $(document).ready(function(){
            $("#password, #password_ubah2").keyup(function(){
                var password_ubah = $("#password").val();
                var ulangi = $("#password_ubah2").val();
                if($("#password").val() == $("#password_ubah2").val()){
                    $('.password_ubah_sama').show(200);
                    $('.password_ubah_tidak_sama').hide(200);
                    $('#btn-register').attr("disabled",false);
                }
                else{
                    $('.password_ubah_sama').hide(200);
                    $('.password_ubah_tidak_sama').show(200);
                    $('#btn-register').attr("disabled",true);
                }
            });
        });
    </script>
</body>

</html>

