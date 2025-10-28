@extends('layouts.welcome')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #74ebd5, #acb6e5);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 40px 30px;
        width: 100%;
        max-width: 500px;
    }
    .login-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
        text-align: center;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(116, 235, 213, 0.5);
        border-color: #74ebd5;
    }
    .btn-primary {
        background-color: #74ebd5;
        border-color: #74ebd5;
        font-weight: bold;
    }
    .btn-primary:hover {
        background-color: #56c9b1;
        border-color: #56c9b1;
    }
    .register-link {
        text-align: left;
        margin-top: 20px;
        font-size: 14px;
    }
</style>

<div class="login-container">
    @if (Route::has('login'))
        @auth
            <div class="text-center text-white">
                <h1>Welcome Back, {{ auth()->user()->name }}</h1>
                <a href="{{ url('/home') }}" class="btn btn-light mt-3">Home</a>
            </div>
        @else
        <div class="login-card">
			            <div class="login-title">{{ __('Pojok Baca Dharma Wanita Persatuan BPS Provinsi Jawa Timur') }}</div>
            <div class="login-title">{{ __('Silakan Login Untuk Meminjam Buku') }}</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label text-dark">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-dark">{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password">

                    @error('password')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2 mb-2">
                    <button type="submit" class="btn btn-primary py-2">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="register-link text-dark">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                </div>

                <div class="text-center mt-4">
                    <small class="text-muted">By: <a href="https://www.youtube.com/"
                            target="_blank">Pojok Baca</a></small>
                </div>
            </form>
        </div>
        @endauth
    @endif
</div>
@endsection
