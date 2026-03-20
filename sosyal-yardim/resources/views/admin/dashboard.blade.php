@extends('layouts.app')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-start py-5" style="min-height: 100vh; padding-top: 80px;">
    <h2 class="mb-5 text-center fw-bold" style="font-size: 3rem;">ADMİN PANELİ</h2>

    <div class="admin-wrapper text-center">

        <a href="{{ route('admin.randevular') }}" class="admin-box text-decoration-none">
            <div class="image-box">
                <img src="{{ asset('images/randevular.png') }}" alt="Randevular" class="rounded-circle bg-white p-2 shadow" style="height: 120px;">
            </div>
            <h4 class="mt-4">RANDEVULAR</h4>
            <p>Randevuları görüntüle ve düzenle.</p>
        </a>

        <a href="{{ route('admin.kullanicilar') }}" class="admin-box text-decoration-none">
            <div class="image-box">
                <img src="{{ asset('images/kullanicilar.png') }}" alt="Kullanıcılar" class="rounded-circle bg-white p-2 shadow" style="height: 120px;">
            </div>
            <h4 class="mt-4">KULLANICILAR</h4>
            <p>Sisteme kayıtlı kullanıcıları incele.</p>
        </a>

        <a href="#" class="admin-box text-decoration-none">
            <div class="image-box">
                <img src="{{ asset('images/istatistik.png') }}" alt="İstatistik" class="rounded-circle bg-white p-2 shadow" style="height: 120px;">
            </div>
            <h4 class="mt-4">İSTATİSTİKLER</h4>
            <p>Genel sistem verilerini görüntüle.</p>
        </a>

        <a href="{{ route('admin.ayarlar.profil') }}" class="admin-box text-decoration-none">
            <div class="image-box">
                <img src="{{ asset('images/ayarlar.png') }}" alt="Ayarlar" class="rounded-circle bg-white p-2 shadow" style="height: 120px;">
            </div>
            <h4 class="mt-4">AYARLAR</h4>
            <p>Profil bilgilerini ve şifreyi yönet.</p>
        </a>

    </div>
</div>

<style>
    .admin-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
    }

    .admin-box {
        background: #ffffff;
        padding: 30px 20px;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
        width: 290px;
        min-height: 320px;
    }

    .admin-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .admin-box h4 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #212529;
    }

    .admin-box p {
        font-size: 1rem;
        color: #6c757d;
        margin-top: 8px;
    }

    @media (max-width: 768px) {
        .admin-box {
            width: 90%;
        }
    }
</style>
@endsection
