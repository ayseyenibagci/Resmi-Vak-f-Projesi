@extends('layouts.app')

@section('content')

<div id="heroSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/slider1.png') }}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/slider2.png') }}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/slider3.png') }}" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

  <div class="carousel-caption d-flex justify-content-center align-items-center">
    <div class="hero-box-transparent">
      <h1>SOSYAL YARDIM RANDEVU SİSTEMİ</h1>
      <p>İhtiyaç sahiplerine hızlı destek</p>
    </div>
  </div>
</div>

<section class="container my-5">
  <h2 class="text-center fw-bold mb-5">Kurumsal Bilgiler</h2>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card card-custom">
        <img src="{{ asset('images/hakkımızda.png') }}" alt="Hakkımızda">
        <h5 class="fw-bold">Hakkımızda</h5>
        <p>Sosyal destekleri ulaştırmak için çalışan bir sistem.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-custom">
        <img src="{{ asset('images/vizyon.png') }}" alt="Vizyon">
        <h5 class="fw-bold">Vizyon</h5>
        <p>Yardımları dijitalleştirerek herkes için eşit erişim sağlamak.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-custom">
        <img src="{{ asset('images/misyon.png') }}" alt="Misyon">
        <h5 class="fw-bold">Misyon</h5>
        <p>Toplumsal dayanışmayı artırmak ve şeffaflığı sağlamak.</p>
      </div>
    </div>
  </div>
</section>

@endsection






