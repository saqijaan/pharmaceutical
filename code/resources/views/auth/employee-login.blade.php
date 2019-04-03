@extends('layouts.app')

@section('logincss')

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login-style/main.css') }}">
    <!--===============================================================================================-->

@endsection


@section('content')




<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					{{ __('Employee Login') }}
				</span>
                <form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="{{ route('employee.login.submit') }}">
                    @csrf

                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input id="email" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('E-Mail Address') }}">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input id="password" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('Password') }}">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn">
                        {{ __('Login') }}
                    </button>
                </div>

            </form>
            @if (Route::has('register'))
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>


@endsection

@section('loginjs')

    <!--===============================================================================================-->
    <script src="{{ asset('login-style/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login-style/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login-style/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('login-style/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login-style/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login-style/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('login-style/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login-style/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login-style/main.js') }}"></script>


@endsection

