@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center py-5">
    <div class="card shadow p-4 text-center" style="max-width: 500px;">
        <img src="{{ asset(auth()->user()->profil_foto ?? 'images/default.png') }}"
             class="rounded-circle mb-3"
             style="width: 120px; height: 120px; object-fit: cover;">

        <h4>{{ auth()->user()->ad }} {{ auth()->user()->soyad }}</h4>
        <p class="text-muted">{{ auth()->user()->email }}</p>
        <p class="text-muted">📞 {{ auth()->user()->telefon }}</p>
        <p class="text-muted">🕓 Kayıt Tarihi: {{ auth()->user()->created_at->format('d.m.Y') }}</p>
    </div>
</div>
@endsection
