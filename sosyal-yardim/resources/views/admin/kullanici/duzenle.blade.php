@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <h2 class="text-center fw-bold mb-4">✏ Kullanıcıyı Düzenle</h2>

    <form method="POST" action="{{ route('admin.kullanicilar.guncelle', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Ad</label>
            <input type="text" name="ad" value="{{ old('ad', $user->ad) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Soyad</label>
            <input type="text" name="soyad" value="{{ old('soyad', $user->soyad) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">E-Posta</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Telefon</label>
            <input type="text" name="telefon" value="{{ old('telefon', $user->telefon) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Şehir</label>
            <input type="text" name="sehir" value="{{ old('sehir', $user->sehir) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Rol</label>
            <select name="role" class="form-select" required>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Kullanıcı</option>
                <option value="uzman" {{ $user->role === 'uzman' ? 'selected' : '' }}>Uzman</option>
            </select>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-warning fw-bold">Kaydet</button>
        </div>
    </form>
</div>
@endsection
