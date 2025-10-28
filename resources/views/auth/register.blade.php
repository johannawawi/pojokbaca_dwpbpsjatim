@extends('layouts.welcome')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #74ebd5, #acb6e5);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .register-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 40px 30px;
        width: 100%;
        max-width: 700px;
    }
    .register-title {
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
    .login-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-title">{{ __('Form Registrasi Pojok Baca DWP BPS Jawa Timur') }}</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NAMA --}}
            <div class="row mb-3 align-items-center">
                <label for="name" class="col-md-4 col-form-label text-md-end text-dark">Nama Lengkap</label>
                <div class="col-md-8">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>

            {{-- ALAMAT --}}
            <div class="row mb-3 align-items-center">
                <label for="alamat" class="col-md-4 col-form-label text-md-end text-dark">Alamat</label>
                <div class="col-md-8">
                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>

            {{-- NO HP --}}
            <div class="row mb-3 align-items-center">
                <label for="noTelp" class="col-md-4 col-form-label text-md-end text-dark">No HP</label>
                <div class="col-md-8">
                    <input id="noTelp" type="text" class="form-control @error('noTelp') is-invalid @enderror"
                        name="noTelp" value="{{ old('noTelp') }}">
                    @error('noTelp')
                        <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>

            {{-- EMAIL --}}
            <div class="row mb-3 align-items-center">
                <label for="email" class="col-md-4 col-form-label text-md-end text-dark">Email</label>
                <div class="col-md-8">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="row mb-3 align-items-center">
                <label for="password" class="col-md-4 col-form-label text-md-end text-dark">Password</label>
                <div class="col-md-8">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password">
                    @error('password')
                        <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="row mb-3 align-items-center">
                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-dark">Konfirmasi Password</label>
                <div class="col-md-8">
                    <input id="password_confirmation" type="password" class="form-control"
                        name="password_confirmation">
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="d-grid gap-2 mb-3 text-center">
                <button type="submit" class="btn btn-primary px-5 py-2">
                    {{ __('Register') }}
                </button>
            </div>

            {{-- LINK LOGIN --}}
            <div class="login-link text-dark">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection
