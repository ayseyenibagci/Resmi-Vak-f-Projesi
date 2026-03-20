@extends('layouts.app')

@section('content')
<style>
    .sifre-wrapper {
        max-width: 850px;
        margin: 50px auto;
        background-color: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
    }

    .sifre-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .sifre-header h2 {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px;
    }

    .btn-kaydet {
        padding: 10px 30px;
        font-weight: bold;
        border-radius: 10px;
    }

    .alert-success, .alert-danger {
        font-weight: bold;
        text-align: center;
    }
</style>

<div class="sifre-wrapper">
    <div class="sifre-header">
        <h2>🔒 Şifre Değiştir</h2>
        <p class="text-muted">Yeni bir şifre belirlemek için aşağıdaki alanları doldurun.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('uzman.sifre.guncelle') }}">
        @csrf

        <div class="form-group">
            <label for="current_password">Mevcut Şifre</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Yeni Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Yeni Şifre (Tekrar)</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-kaydet">Şifreyi Güncelle</button>
        </div>
    </form>
</div>
@endsection
