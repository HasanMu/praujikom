@extends('layouts.login')

@section('title', 'Register')
@section('content')
<div class="login-form">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="avatar">
            <img src="https://www.tutorialrepublic.com/examples/images/avatar.png" alt="Avatar">
        </div>
        <h2 class="text-center">Daftar untuk bergabung!</h2>   
        <div class="form-group">
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama lengkap">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>  
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Password Konfirmasi">
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
    <p class="text-center small">have an account? <a href="{{ route('login') }}">Sign in here!</a></p>
</div>
@endsection
