@extends('layouts.app')

@section('content')
<div class="container my-5 text-center">
    <h2 class="fw-bold mb-2">EKİBİMİZ</h2>
    <p class="lead text-muted mb-5">Uzman Kadromuz ile Destekçiniziz</p>


    <div class="mb-5">
        <img src="{{ asset('images/kurucu.png') }}" class="rounded-circle ekip-img mb-2" width="150" height="150" alt="Kurucu">
        <h5 class="fw-bold">Ayşe Yenibağcı</h5>
        <p class="text-muted">Kurucu & Strateji Mimarı</p>
    </div>


    <div class="row justify-content-center mb-5">
        <div class="col-md-3 text-center">
            <img src="{{ asset('images/bb.png') }}" class="rounded-circle ekip-img mb-2" width="130" height="130" alt="Uzman 1">
            <h6 class="fw-bold">Berat Baran Balcı</h6>
            <p class="text-muted">Bölgesel Uzman Koordinatörü</p>
        </div>
        <div class="col-md-3 text-center">
            <img src="{{ asset('images/safa.png') }}" class="rounded-circle ekip-img mb-2" width="130" height="130" alt="Uzman 2">
            <h6 class="fw-bold">Safa Kayalar</h6>
            <p class="text-muted">Kurumsal İlişkiler ve Hukuk Yöneticisi</p>
        </div>
    </div>

 
    <div class="row justify-content-center">
        <div class="col-md-2 text-center">
            <img src="{{ asset('images/iclal.png') }}" class="rounded-circle ekip-img mb-2" width="110" height="110" alt="Uzman 3">
            <h6 class="fw-bold">İclal Kılıç</h6>
            <p class="text-muted">Eğitim ve Proje Geliştirme Sorumlusu</p>
        </div>
        <div class="col-md-2 text-center">
            <img src="{{ asset('images/ilknur.png') }}" class="rounded-circle ekip-img mb-2" width="110" height="110" alt="Uzman 4">
            <h6 class="fw-bold">İlknur Kaplan</h6>
            <p class="text-muted">Saha Operasyonları Koordinatörü</p>
        </div>
        <div class="col-md-2 text-center">
            <img src="{{ asset('images/zaur.png') }}" class="rounded-circle ekip-img mb-2" width="110" height="110" alt="Uzman 5">
            <h6 class="fw-bold">Zaur Hacizalov</h6>
            <p class="text-muted">Sosyal Hizmet Planlayıcısı</p>
        </div>
    </div>
</div>
@endsection

