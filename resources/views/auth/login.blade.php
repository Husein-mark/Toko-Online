@extends('layouts.app')

@section('title', 'Masuk ke Akun')

@push('styles')
<style>
    .auth-page {
        min-height: calc(100vh - 180px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .auth-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        width: 100%;
        max-width: 420px;
        overflow: hidden;
    }

    .auth-header {
        padding: 28px 32px 20px;
        text-align: center;
        border-bottom: 1px solid var(--gray-100);
    }

    .auth-logo {
        font-size: 22px;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .auth-logo span { color: var(--brand-blue); }

    .auth-subtitle {
        font-size: 13px;
        color: var(--gray-500);
    }

    .auth-body {
        padding: 28px 32px;
    }

    .form-group { margin-bottom: 18px; }

    .form-label {
        display: block;
        font-weight: 600;
        font-size: 13px;
        color: var(--gray-700);
        margin-bottom: 6px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 13.5px;
        font-family: inherit;
        color: var(--gray-900);
        transition: var(--transition);
        outline: none;
    }

    .form-control:focus { border-color: var(--brand-blue); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
    .form-control.is-invalid { border-color: #ef4444; }

    .form-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
    }

    .btn-login {
        width: 100%;
        padding: 11px;
        background: var(--brand-blue);
        color: var(--white);
        border: none;
        border-radius: var(--radius);
        font-size: 14px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-login:hover { background: var(--brand-blue-hover); }

    .auth-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 13.5px;
        color: var(--gray-500);
        padding-top: 20px;
        border-top: 1px solid var(--gray-100);
    }

    .auth-footer a { color: var(--brand-blue); font-weight: 600; }
    .auth-footer a:hover { text-decoration: underline; }

    .demo-info {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        padding: 12px 14px;
        font-size: 12.5px;
        color: var(--gray-600);
        margin-bottom: 20px;
        line-height: 1.5;
    }
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-store" style="color:var(--brand-blue);"></i> Nusa<span>Mart</span>
            </div>
            <div class="auth-subtitle">Masuk ke Akun Anda untuk Bertransaksi</div>
        </div>

        <div class="auth-body">
            <div class="demo-info">
                <strong style="color:var(--gray-800);"><i class="fas fa-key" style="color:var(--brand-blue);"></i> Akun Demo:</strong><br>
                • Admin: <code>admin@nusamart.id</code> / <code>password</code><br>
                • Pembeli: <code>budi@gmail.com</code> / <code>password</code>
            </div>

            @if($errors->any())
                <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:var(--radius); padding:10px 14px; margin-bottom:18px; font-size:13px; color:#991b1b;">
                    @foreach($errors->all() as $error)
                        <div><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:24px;">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-right-to-bracket"></i> Masuk Sekarang
                </button>
            </form>

            <div class="auth-footer">
                Belum memiliki akun? <a href="{{ route('register') }}">Daftar Bebas Biaya</a>
            </div>
        </div>
    </div>
</div>
@endsection
