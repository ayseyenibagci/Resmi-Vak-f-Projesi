@extends('layouts.app')

@section('content')
<style>
    .kullanici-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 40px;
    }

    .kullanici-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .kullanici-header h2 {
        font-weight: bold;
        font-size: 2rem;
    }

    .form-inline {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .table-container {
        margin-top: 20px;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
        padding: 12px 14px;
        white-space: nowrap;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 30px;
    }

    .pagination li {
        list-style: none;
    }

    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 14px;
        border-radius: 8px;
        background-color: #f8f9fa;
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .pagination li a:hover {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .pagination .active span {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .new-user-form {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }

    .new-user-form h4 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .pagination ~ div,
    .pagination + div,
    .pagination-info,
    .pagination-summary,
    .pagination .text-sm,
    .pagination small,
    .pagination p,
    .pagination span.d-inline-block {
        display: none !important;
    }
</style>

<div class="container kullanici-wrapper">
    <div class="kullanici-header">
        <h2>🙋 Tüm Kullanıcılar</h2>
    </div>

    <form method="GET" class="form-inline">
        <input type="text" name="arama" value="{{ request('arama') }}" class="form-control" placeholder="Ad, soyad, e-posta...">
        <select name="rol" class="form-select">
            <option value="">Tüm Roller</option>
            <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ request('rol') == 'user' ? 'selected' : '' }}>Kullanıcı</option>
            <option value="uzman" {{ request('rol') == 'uzman' ? 'selected' : '' }}>Uzman</option>
        </select>
        <button class="btn btn-primary">Filtrele</button>
    </form>

    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Rol</th>
                    <th>Oluşturulma</th>
                    <th>Şehir</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kullanicilar as $user)
                    <tr>
                        <td>{{ $user->ad ?? '-' }}</td>
                        <td>{{ $user->soyad ?? '-' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telefon ?? '-' }}</td>
                        <td>{{ $user->role ?? 'user' }}</td>
                        <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $user->sehir ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.kullanicilar.duzenle', $user->id) }}" class="btn btn-warning btn-sm">✏️</a>
                            <form action="{{ route('admin.kullanicilar.sil', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Silmek istediğine emin misin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">❌</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Hiç kullanıcı bulunamadı.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $kullanicilar->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

 
    <div class="new-user-form">
        <h4>➕ Yeni Kullanıcı Ekle</h4>
        <form action="{{ route('admin.kullanicilar.ekle') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="ad" class="form-control" placeholder="Ad" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="soyad" class="form-control" placeholder="Soyad" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="E-Posta" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="telefon" class="form-control" placeholder="Telefon" required>
                </div>
                <div class="col-md-6">
                    <input type="password" name="password" class="form-control" placeholder="Şifre" required>
                </div>
                <div class="col-md-6">
                    <select name="role" class="form-select" required>
                        <option value="">Rol Seçiniz</option>
                        <option value="admin">Admin</option>
                        <option value="user">Kullanıcı</option>
                        <option value="uzman">Uzman</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="sehir" class="form-control" required>
                        <option value="">Şehir seçiniz</option>
                        @php
                            $iller = [
                                'Adana', 'Adıyaman', 'Afyonkarahisar', 'Ağrı', 'Aksaray', 'Amasya', 'Ankara', 'Antalya',
                                'Artvin', 'Aydın', 'Balıkesir', 'Bartın', 'Batman', 'Bayburt', 'Bilecik', 'Bingöl', 'Bitlis',
                                'Bolu', 'Burdur', 'Bursa', 'Çanakkale', 'Çankırı', 'Çorum', 'Denizli', 'Diyarbakır', 'Düzce',
                                'Edirne', 'Elazığ', 'Erzincan', 'Erzurum', 'Eskişehir', 'Gaziantep', 'Giresun', 'Gümüşhane',
                                'Hakkâri', 'Hatay', 'Iğdır', 'Isparta', 'İstanbul', 'İzmir', 'Kahramanmaraş', 'Karabük',
                                'Karaman', 'Kars', 'Kastamonu', 'Kayseri', 'Kırıkkale', 'Kırklareli', 'Kırşehir', 'Kilis',
                                'Kocaeli', 'Konya', 'Kütahya', 'Malatya', 'Manisa', 'Mardin', 'Mersin', 'Muğla', 'Muş',
                                'Nevşehir', 'Niğde', 'Ordu', 'Osmaniye', 'Rize', 'Sakarya', 'Samsun', 'Şanlıurfa', 'Siirt',
                                'Sinop', 'Şırnak', 'Sivas', 'Tekirdağ', 'Tokat', 'Trabzon', 'Tunceli', 'Uşak', 'Van',
                                'Yalova', 'Yozgat', 'Zonguldak'
                            ];
                        @endphp

                        @foreach ($iller as $il)
                            <option value="{{ $il }}">{{ $il }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success px-5">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection






