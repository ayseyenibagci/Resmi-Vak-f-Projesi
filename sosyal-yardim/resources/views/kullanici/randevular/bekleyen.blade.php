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
        <h2>🔄 Bekleyen Randevularım</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center fw-bold">
            {{ session('success') }}
        </div>
    @endif

    @if ($randevular->count())
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tarih</th>
                        <th>Saat</th>
                        <th>Randevu Türü</th>
                        <th>Açıklama</th>
                        <th>Uzman</th> 
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($randevular as $randevu)
                        <tr>
                            <td>{{ $randevu->tarih }}</td>
                            <td>{{ $randevu->saat }}</td>
                            <td>{{ $randevu->randevu_turu }}</td>
                            <td>{{ $randevu->aciklama }}</td>
                            <td>{{ $randevu->uzman ?? '-' }}</td>
                            <td>
                                <a href="{{ route('kullanici.randevu.duzenle', $randevu->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                                <form action="{{ route('kullanici.randevu.sil', $randevu->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bu randevuyu silmek istediğine emin misin?')">
                                        Sil
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @else
        <div class="alert alert-info">Henüz bekleyen randevunuz yok.</div>
    @endif



</div>
@endsection
