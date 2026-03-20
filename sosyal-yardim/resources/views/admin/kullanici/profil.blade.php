@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h4 class="text-center mb-4">👤 Profil Bilgileri</h4>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="ad" class="form-label">Ad</label>
                <input type="text" class="form-control" id="ad" name="ad" value="{{ auth()->user()->ad }}">
            </div>

            <div class="mb-3">
                <label for="soyad" class="form-label">Soyad</label>
                <input type="text" class="form-control" id="soyad" name="soyad" value="{{ auth()->user()->soyad }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
            </div>

            <div class="mb-3">
                <label for="telefon" class="form-label">Telefon</label>
                <input type="text" class="form-control" id="telefon" name="telefon" value="{{ auth()->user()->telefon }}">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Güncelle</button>
            </div>
        </form>
    </div>
</div>
@endsection

