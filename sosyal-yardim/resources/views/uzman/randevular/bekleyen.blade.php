@extends('layouts.app')

@section('content')
<style>
    .randevu-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 40px;
    }

    .randevu-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .randevu-header h2 {
        font-weight: bold;
        font-size: 2rem;
    }

    .table-container {
        margin-top: 20px;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle !important;
        font-weight: bold;
        padding: 12px 14px;
        white-space: nowrap;
    }

    .alert-info {
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
    }
</style>

<div class="randevu-wrapper">
    <div class="randevu-header">
        <h2>🔄 Bekleyen Randevular</h2>
    </div>

    @if ($randevular->count() > 0)
        <div class="table-container table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Kullanıcı Adı</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Randevu Türü</th>
                        <th>Tarih</th>
                        <th>Saat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($randevular as $index => $randevu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $randevu->ad }} {{ $randevu->soyad }}</td>
                            <td>{{ $randevu->email }}</td>
                            <td>{{ $randevu->telefon }}</td>
                            <td>{{ $randevu->randevu_turu }}</td>
                            <td>{{ \Carbon\Carbon::parse($randevu->tarih)->format('d.m.Y') }}</td>
                            <td>{{ $randevu->saat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Bekleyen randevu bulunmamaktadır.</div>
    @endif
</div>
@endsection
