@extends('auth/master')
@section('content')
<div class="login-box">


    <div class="login-box-body">
        <div class="login-logo">
            <a href="{{ url('') }}"><b>PARKING LOGIN</b></a>
        </div>

        <form  method="post" action="{{ route('login') }}">
        {{ csrf_field() }}
            <div class="form-group has-feedback">

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password"  required>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"  {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">

                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ __('Login') }}
                    </button>

                </div>
                <!-- /.col -->
            </div>
        </form>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Password') }}
        </a>
        @endif
        @if (Route::has('register'))

        <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>

        @endif
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
