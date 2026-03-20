@extends('layouts.app')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-start py-5" style="min-height: 100vh; padding-top: 80px;">
    <h2 class="mb-5 text-center" style="font-size: 3rem; font-weight: bold;">UZMAN PANELİ</h2>

    <div class="admin-wrapper text-center">

        <a href="{{ route('uzman.randevular.bekleyen') }}" class="admin-box text-decoration-none">
            <div class="image-box">
                <img src="{{ asset('images/bekleyen.png') }}" alt="Bekleyen" class="rounded-circle bg-white p-2 shadow" style="height: 130px;">
            </div>
            <h4 class="text-dark mt-4">BEKLEYEN RANDEVULAR</h4>
            <p class="text-muted">Kendinize atanmış bekleyen randevuları görüntüleyin.</p>
        </a>

        <a href="{{ route('uzman.randevular.gecmis') }}" class="admin-box text-decoration-none">
            <div class="image-box">
                <img src="{{ asset('images/geçmiş.png') }}" alt="Geçmiş" class="rounded-circle bg-white p-2 shadow" style="height: 130px;">
            </div>
            <h4 class="text-dark mt-4">GEÇMİŞ RANDEVULAR</h4>
            <p class="text-muted">Geçmişte gerçekleşmiş randevularınızı görüntüleyin.</p>
        </a>

        <a href="{{ route('uzman.profil') }}" class="admin-box text-decoration-none">
            <div class="image-box">
                <img src="{{ asset('images/profilim.png') }}" alt="Profil" class="rounded-circle bg-white p-2 shadow" style="height: 130px;">
            </div>
            <h4 class="text-dark mt-4">PROFİLİM</h4>
            <p class="text-muted">Kişisel bilgilerinizi ve şifrenizi yönetin.</p>
        </a>

    </div>
</div>

<style>
    .admin-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 3rem;
        flex-wrap: wrap;
        margin-top: 30px;
    }

    .admin-box {
        background: #fff;
        padding: 35px;
        border-radius: 16px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 320px;
        height: 340px;
        text-align: center;
    }

    .admin-box:hover {
        transform: scale(1.05);
        box-shadow: 0 0 35px rgba(0, 0, 0, 0.25);
    }

    .admin-box h4 {
        font-size: 1.6rem;
        font-weight: 600;
    }

    .admin-box p {
        font-size: 1rem;
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .admin-box {
            width: 90%;
            height: auto;
        }
    }
</style>
@endsection


