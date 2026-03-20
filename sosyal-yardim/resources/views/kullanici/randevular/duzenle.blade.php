@extends('layouts.app')

@section('content')
<style>
    .form-wrapper {
        max-width: 600px;
        margin: 0 auto;
        padding-top: 40px;
    }

    .form-wrapper h2 {
        font-weight: bold;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 12px;
        font-size: 1rem;
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        font-size: 1.1rem;
    }
</style>

<div class="form-wrapper">
    <h2>Randevuyu Düzenle</h2>

    <form action="{{ route('kullanici.randevu.guncelle', $randevu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Ad</label>
            <input type="text" name="ad" class="form-control" value="{{ old('ad', $randevu->ad) }}" required>
        </div>

        <div class="form-group">
            <label>Soyad</label>
            <input type="text" name="soyad" class="form-control" value="{{ old('soyad', $randevu->soyad) }}" required>
        </div>

        <div class="form-group">
            <label>E-Posta</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $randevu->email) }}" required>
        </div>

        <div class="form-group">
            <label>Telefon</label>
            <input type="text" name="telefon" class="form-control" value="{{ old('telefon', $randevu->telefon) }}" required>
        </div>

        <div class="form-group">
            <label>Randevu Türü</label>
            <input type="text" name="randevu_turu" class="form-control" value="{{ old('randevu_turu', $randevu->randevu_turu) }}" required>
        </div>

        <div class="form-group">
            <label>Tarih</label>
            <input type="date" name="tarih" class="form-control" value="{{ old('tarih', $randevu->tarih) }}" required>
        </div>

        <div class="form-group">
            <label>Saat</label>
            <input type="time" name="saat" class="form-control" value="{{ old('saat', $randevu->saat) }}" required>
        </div>

        <div class="form-group">
            <label>Açıklama</label>
            <textarea name="aciklama" class="form-control">{{ old('aciklama', $randevu->aciklama) }}</textarea>
        </div>
        

        <button type="submit" class="btn btn-primary">Randevuyu Güncelle</button>
    </form>
</div>
@endsection
