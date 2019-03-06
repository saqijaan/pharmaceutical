@extends('layouts.app')

@section('registercss')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

@endsection

@section('content')


    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2 class="form-title">{{ __('Register') }}</h2>
                        <div class="form-group">
                            <input id="name" type="text" class="form-input {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('Name') }}" />


                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <input id="email" type="email" class="form-input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}">
                        </div>

                        <div class="form-group">
                            <input id="password" type="text" class="form-input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('Password') }}">
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required placeholder="{{ __('Confirm Password') }}">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="{{ __('Register') }}"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="{{ route('login') }}" class="loginhere-link">{{ __('Login') }}</a>
                    </p>
                </div>
            </div>
        </section>

    </div>






@endsection

@section('registerjs')

    <!-- JS -->
    <script src="{{ asset('registerjs/jquery.min.js') }}"></script>
    <script src="{{ asset('registerjs/main.js') }}"></script>

@endsection
