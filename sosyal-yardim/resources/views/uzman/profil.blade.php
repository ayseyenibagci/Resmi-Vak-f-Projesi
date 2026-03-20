@extends('layouts.app')

@section('content')
<style>
    .profil-wrapper {
        max-width: 850px;
        margin: 50px auto;
        background-color: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
    }

    .profil-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profil-header h2 {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .nav-tabs .nav-link.active {
        font-weight: bold;
        background-color: #f8f9fa;
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

    .profil-resim {
        max-height: 80px;
        margin-left: 15px;
        border-radius: 10px;
    }

    .alert-success {
        font-weight: bold;
        text-align: center;
    }
</style>

<div class="profil-wrapper">
    <div class="profil-header">
        <h2>👤 Profil Ayarları</h2>
        <p class="text-muted">Profil bilgilerinizi aşağıdan güncelleyebilirsiniz.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#profilBilgileri">Profil Bilgileri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('uzman.sifre.form') }}">🔒 Şifreyi Değiştir</a>
        </li>

    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="profilBilgileri">
            <form action="{{ route('uzman.profil.guncelle') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="ad">Ad</label>
                        <input type="text" name="ad" class="form-control" value="{{ old('ad', $user->ad) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="soyad">Soyad</label>
                        <input type="text" name="soyad" class="form-control" value="{{ old('soyad', $user->soyad ?? '') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="email">E-Posta</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="telefon">Telefon</label>
                        <input type="text" name="telefon" class="form-control" value="{{ old('telefon', $user->telefon ?? '') }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="sehir">Şehir</label>
                        <input type="text" name="sehir" class="form-control" value="{{ old('sehir', $user->sehir ?? '') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="role">Rol</label>
                        <input type="text" name="role" class="form-control" value="{{ $user->role }}" readonly>
                    </div>

                    <div class="col-md-12 form-group d-flex align-items-center">
                        <div style="flex-grow: 1">
                            <label for="profil_resmi">Profil Resmi</label>
                            <input type="file" name="profil_resmi" class="form-control">
                        </div>

                        @if ($user->profil_resmi)
                            <img src="{{ asset('storage/' . $user->profil_resmi) }}" class="profil-resim" alt="Profil Resmi">
                        @else
                            <span class="text-muted ms-3">Henüz fotoğraf yüklenmemiş.</span>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-kaydet">Kaydet</button>
                </div>
            </form>
        </div>



@endsection

