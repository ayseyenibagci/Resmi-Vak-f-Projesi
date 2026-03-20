@extends('layouts.app')

@section('content')
<style>
    .sifre-wrapper {
        max-width: 600px;
        margin: 60px auto;
        background-color: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    }

    .sifre-wrapper h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.8rem;
        font-weight: bold;
        color: #002f6c;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
    }

    .btn-guncelle {
        width: 100%;
        padding: 12px;
        font-weight: bold;
        border-radius: 10px;
    }

    .alert {
        font-weight: bold;
        text-align: center;
    }
</style>

<div class="sifre-wrapper">
    <h2>🔒 Şifre Değiştir</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('kullanici.sifre.guncelle') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="mevcut_sifre">Mevcut Şifreniz</label>
            <input type="password" name="mevcut_sifre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="yeni_sifre">Yeni Şifre</label>
            <input type="password" name="yeni_sifre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="yeni_sifre_tekrar">Yeni Şifre (Tekrar)</label>
            <input type="password" name="yeni_sifre_tekrar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-danger btn-guncelle">Şifreyi Güncelle</button>
    </form>
</div>
@endsection

