@extends('layouts.app')

@section('content')
<style>
    .randevu-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding-top: 40px;
    }

    .randevu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .randevu-header .center {
        text-align: center;
        width: 100%;
    }

    .randevu-header h2 {
        font-weight: bold;
        font-size: 2rem;
        margin: 0;
    }

    .btn-new {
        font-weight: bold;
        white-space: nowrap;
    }

    .filter-form .form-control,
    .filter-form .btn {
        font-weight: bold;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table thead th {
        background-color: #f8f9fa;
    }
</style>

<div class="container randevu-wrapper">

    <div class="text-center mb-4">
        <a href="{{ route('admin.randevular', ['tip' => 'bekleyen']) }}"
           class="btn {{ $tip === 'bekleyen' ? 'btn-primary' : 'btn-outline-primary' }}">
            🔵 Bekleyen Randevular
        </a>
        <a href="{{ route('admin.randevular', ['tip' => 'gecmis']) }}"
           class="btn {{ $tip === 'gecmis' ? 'btn-primary' : 'btn-outline-primary' }}">
            ⏳ Geçmiş Randevular
        </a>
    </div>

    <div class="randevu-header">
        <div class="center">
            <h2>📅 {{ $tip === 'gecmis' ? 'Geçmiş' : 'Bekleyen' }} Randevular</h2>
        </div>
        <div class="text-end">
            <a href="{{ route('admin.randevular.create') }}" class="btn btn-success btn-new">➕ Yeni Randevu</a>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.randevular', ['tip' => $tip]) }}" class="row filter-form g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Ad, soyad, e-posta, tür..."
                   value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="tarih" class="form-control" value="{{ request('tarih') }}">
        </div>
        <div class="col-md-3 text-end">
            <button type="submit" class="btn btn-primary me-2">Filtrele</button>
            <a href="{{ route('admin.randevular', ['tip' => $tip]) }}" class="btn btn-secondary">Temizle</a>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Randevu Türü</th>
                <th>Tarih</th>
                <th>Saat</th>
                <th>Açıklama</th>
                <th>Uzman</th>
                <th>İşlem</th>
            </tr>
            </thead>
            <tbody>
            @forelse($randevular as $randevu)
                <tr>
                    <td>{{ $randevu->ad }}</td>
                    <td>{{ $randevu->soyad }}</td>
                    <td>{{ $randevu->email }}</td>
                    <td>{{ $randevu->telefon }}</td>
                    <td>{{ $randevu->randevu_turu }}</td>
                    <td>{{ $randevu->tarih }}</td>
                    <td>{{ $randevu->saat }}</td>
                    <td>{{ $randevu->aciklama }}</td>
                    <td>{{ $randevu->uzman ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.randevular.edit', $randevu->id) }}" class="btn btn-warning btn-sm">✏️</a>
                        <form action="{{ route('admin.randevular.destroy', $randevu->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')">🗑</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Hiç randevu bulunamadı.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection










