@extends('auth/master')
@section('content')
<div class="login-box">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="login-box-body">
        <div class="login-logo">
            <a href="{{ url('') }}"><b>PARKING RESET PASSWORD</b></a>
        </div>

        <form  method="post" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group has-feedback">

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row">

                <div class="col-xs-4">

                    <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                    </button>

                </div>
                <!-- /.col -->
            </div>
        </form>

        @if (Route::has('register'))

        <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>

        @endif
        @if (Route::has('login'))

        <a class="btn btn-link" href="{{ route('login') }}">{{ __('Already have an account ?') }}</a>

        @endif
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
