@extends('layouts.login')

@section('title', 'Login')
@section('content')
    <div class="login-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="avatar">
                <img src="https://www.tutorialrepublic.com/examples/images/avatar.png" alt="Avatar">
            </div>
            <h2 class="text-center">Silahkan Masuk</h2>   
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>        
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </div>
            <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="pull-right">Forgot Password?</a>
                @endif
            </div>
        </form>
        <p class="text-center small">Don't have an account? <a href="{{ route('register') }}">Sign up here!</a></p>
    </div>
@endsection