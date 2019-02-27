@extends('auth/master')
@section('content')

<div class="register-box">

    <div class="register-box-body">
        <div class="register-logo">
            <a href="{{ url('') }}"><b>PARKING RESET PASSWORD</b></a>
        </div>
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Pasword" required>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                    </button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        @if (Route::has('login'))

        <a class="btn btn-link" href="{{ route('login') }}">{{ __('Already have an account ?') }}</a>

        @endif
        @if (Route::has('register'))

        <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>

        @endif

    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection
