@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">👤 Kullanıcıyı Düzenle</h2>

    <form action="{{ route('admin.kullanici.guncelle', $kullanici->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Ad Soyad</label>
            <input type="text" name="name" value="{{ $kullanici->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>E-posta</label>
            <input type="email" name="email" value="{{ $kullanici->email }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href="{{ route('admin.kullanicilar') }}" class="btn btn-secondary">İptal</a>
    </form>
</div>
@endsection
