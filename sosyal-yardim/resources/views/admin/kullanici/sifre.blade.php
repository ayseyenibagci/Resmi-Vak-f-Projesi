@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h4 class="text-center mb-4">🔒 Şifre Değiştir</h4>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Mevcut Şifre</label>
                <input type="password" class="form-control" name="current_password" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Yeni Şifre</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Şifreyi Güncelle</button>
            </div>
        </form>
    </div>
</div>
@endsection
