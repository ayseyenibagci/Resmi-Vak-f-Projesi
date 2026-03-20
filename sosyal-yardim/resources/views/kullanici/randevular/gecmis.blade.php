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

    .table th, .table td {
        text-align: center;
        vertical-align: middle !important;
        padding: 12px 14px;
        font-weight: bold;
        white-space: nowrap;
    }

    .alert-info {
        text-align: center;
        font-weight: bold;
        margin-top: 20px;
    }
</style>

<div class="randevu-wrapper">
    <div class="randevu-header">
        <h2>📜 Geçmiş Randevularım</h2>
    </div>

    @if ($randevular->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Randevu Türü</th>
                        <th>Tarih</th>
                        <th>Saat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($randevular as $index => $randevu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $randevu->randevu_turu }}</td>
                            <td>{{ \Carbon\Carbon::parse($randevu->tarih)->format('d.m.Y') }}</td>
                            <td>{{ $randevu->saat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Henüz geçmiş randevunuz bulunmamaktadır.</div>
    @endif
</div>
@endsection
