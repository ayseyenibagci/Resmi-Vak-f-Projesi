@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <h2 class="text-center fw-bold mb-4">🙋 Yeni Kullanıcı Ekle</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.kullanicilar.ekle') }}">
        @csrf

        <!-- Ad -->
        <div class="mb-3">
            <label class="form-label fw-bold">Ad</label>
            <input type="text" name="ad" class="form-control" required>
        </div>

        <!-- Soyad -->
        <div class="mb-3">
            <label class="form-label fw-bold">Soyad</label>
            <input type="text" name="soyad" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label fw-bold">E-posta</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Telefon -->
        <div class="mb-3">
            <label class="form-label fw-bold">Telefon</label>
            <input type="text" name="telefon" class="form-control" required>
        </div>

        <!-- Şifre -->
        <div class="mb-3">
            <label class="form-label fw-bold">Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Rol -->
        <div class="mb-3">
            <label class="form-label fw-bold">Rol</label>
            <select name="role" class="form-select" required>
                <option value="user">Kullanıcı</option>
                <option value="admin">Admin</option>
                <option value="uzman">Uzman</option>
            </select>
        </div>

        <!-- Buton -->
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary fw-bold">➕ Kullanıcı Ekle</button>
        </div>
    </form>
</div>
@endsection
