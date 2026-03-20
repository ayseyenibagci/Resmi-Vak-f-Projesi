@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">👤 Yeni Kullanıcı Ekle</h2>

    <form method="POST" action="{{ route('admin.kullanici.kaydet') }}">
        @csrf
        <div class="mb-3">
            <label>Ad Soyad</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="{{ route('admin.kullanicilar') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
</div>
@endsection
