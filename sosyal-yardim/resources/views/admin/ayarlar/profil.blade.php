@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 1000px;">
    <h3 class="mb-2">👤 Profil Ayarları</h3>
    <p class="text-muted mb-4">Profil bilgilerinizi aşağıdan güncelleyebilirsiniz.</p>

    <!-- Sekmeler -->
    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#profil">Profil Bilgileri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#sifre">Şifreyi Değiştir</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Profil -->
        <div class="tab-pane fade show active" id="profil">
            <form method="POST" action="{{ route('admin.ayarlar.profil.guncelle') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Ad</label>
                        <input type="text" name="ad" class="form-control" value="{{ old('ad', $admin->ad) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Soyad</label>
                        <input type="text" name="soyad" class="form-control" value="{{ old('soyad', $admin->soyad ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">E-Posta</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="telefon" class="form-control" value="{{ old('telefon', $admin->telefon ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Şehir</label>
                        <input type="text" name="sehir" class="form-control" value="{{ old('sehir', $admin->sehir ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Rol</label>
                        <input type="text" class="form-control" value="{{ $admin->role }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Profil Resmi</label>
                        <input type="file" name="profil_foto" class="form-control">
                    </div>

                    <div class="col-md-6 d-flex align-items-end">
                        @if ($admin->profil_foto)
                            <img src="{{ asset($admin->profil_foto) }}" alt="Profil" class="rounded" style="height: 100px;">
                        @else
                            <span class="text-muted">Henüz fotoğraf yüklenmemiş.</span>
                        @endif
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success px-5">Kaydet</button>
                </div>
            </form>
        </div>

        <!-- Şifre -->
        <div class="tab-pane fade" id="sifre">
            <form method="POST" action="{{ route('admin.ayarlar.sifre.guncelle') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Mevcut Şifre</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Yeni Şifre</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Yeni Şifre (Tekrar)</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-5">Şifreyi Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection








