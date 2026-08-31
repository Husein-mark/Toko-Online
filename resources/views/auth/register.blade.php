@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

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
        max-width: 480px;
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

    .auth-subtitle { font-size: 13px; color: var(--gray-500); }
    .auth-body { padding: 28px 32px; }

    .form-group { margin-bottom: 18px; }
    .form-label { display: block; font-weight: 600; font-size: 13px; color: var(--gray-700); margin-bottom: 6px; }

    .input-wrapper { position: relative; }
    .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 14px; }

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

    textarea.form-control { padding-left: 14px; }
    .form-control:focus { border-color: var(--brand-blue); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
    .form-control.is-invalid { border-color: #ef4444; }
    .form-error { font-size: 12px; color: #ef4444; margin-top: 4px; }

    .btn-register {
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
        margin-top: 8px;
    }

    .btn-register:hover { background: var(--brand-blue-hover); }

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
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-store" style="color:var(--brand-blue);"></i> Nusa<span>Mart</span>
            </div>
            <div class="auth-subtitle">Pendaftaran Akun Pembeli Baru</div>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            placeholder="Nama sesuai identitas" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email <span style="color:#ef4444;">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon / WhatsApp</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                            placeholder="0812xxxxxxxx" value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Alamat Pengiriman Utama</label>
                    <textarea id="address" name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                        rows="2" placeholder="Nama Jalan, No. Rumah, RT/RW, Kecamatan, Kota">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password <span style="color:#ef4444;">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Minimal 6 karakter" required>
                    </div>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password <span style="color:#ef4444;">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-check-circle input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-check"></i> Daftar Akun NusaMart
                </button>
            </form>

            <div class="auth-footer">
                Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection
