@extends('layouts.app')

@section('content')
@php
    $saatler = [];
    for ($i = 8; $i <= 16; $i++) {
        $saatler[] = sprintf('%02d:00', $i);
        $saatler[] = sprintf('%02d:30', $i);
    }
@endphp

<style>
    .randevu-form-wrapper {
        max-width: 600px;
        margin: 0 auto;
        padding-top: 40px;
    }

    .randevu-form h2 {
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
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 12px;
        font-size: 1rem;
        font-weight: 500;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .form-check {
        margin-bottom: 10px;
    }

    .form-check-input {
        margin-right: 10px;
        transform: scale(1.2);
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        font-size: 1.1rem;
        font-weight: bold;
        border-radius: 10px;
    }

    textarea.form-control {
        resize: vertical;
    }
</style>

<div class="container randevu-form-wrapper">
    <div class="randevu-form">
        <h2>✏️ Randevu Düzenle</h2>

        {{-- Hata mesajları --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $hata)
                        <li>{{ $hata }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.randevular.update', $randevu->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Ad</label>
                <input type="text" name="ad" class="form-control" value="{{ $randevu->ad }}" required>
            </div>

            <div class="form-group">
                <label>Soyad</label>
                <input type="text" name="soyad" class="form-control" value="{{ $randevu->soyad }}" required>
            </div>

            <div class="form-group">
                <label>E-posta</label>
                <input type="email" name="email" class="form-control" value="{{ $randevu->email }}" required>
            </div>

            <div class="form-group">
                <label>Telefon</label>
                <input type="text" name="telefon" class="form-control" value="{{ $randevu->telefon }}" required>
            </div>

            <div class="form-group">
                <label>Randevu Türü</label>
                @php
                    $turler = [
                        'Psikolojik Destek',
                        'Maddi Yardım',
                        'Eğitim Desteği',
                        'Hukuki Danışmanlık',
                        'Barınma Yardımı',
                        'Sağlık Hizmeti',
                        'Gıda Yardımı',
                        'İstihdam Danışmanlığı',
                        'Sosyal Hizmet Görüşmesi',
                        'Diğer'
                    ];
                    $seciliTurler = explode(',', $randevu->randevu_turu);
                @endphp

                @foreach($turler as $index => $tur)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="randevu_turu[]" value="{{ $tur }}"
                               id="tur{{ $index }}" {{ in_array($tur, $seciliTurler) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tur{{ $index }}">{{ $tur }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label>Tarih</label>
                <input type="date" name="tarih" class="form-control" value="{{ $randevu->tarih }}" required>
            </div>

            <div class="form-group">
                <label>Saat</label>
                <select name="saat" class="form-control" required>
                    <option value="">Saat seçiniz</option>
                    @foreach($saatler as $saat)
                        @if($saat >= '12:00' && $saat < '13:00') @continue @endif
                        <option value="{{ $saat }}" {{ $randevu->saat == $saat ? 'selected' : '' }}>{{ $saat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="aciklama" class="form-control" rows="4" maxlength="50">{{ $randevu->aciklama }}</textarea>
            </div>

            <div class="form-group">
                <label>Şehir Seç</label>
                <select id="sehirSelect" name="sehir" class="form-control" required>
                    <option value="">Şehir seçiniz</option>
                    @php
                        $iller = \App\Models\User::where('role', 'uzman')->distinct()->pluck('sehir');
                    @endphp
                    @foreach($iller as $il)
                        <option value="{{ $il }}" {{ $randevu->sehir == $il ? 'selected' : '' }}>{{ $il }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Uzman Seç</label>
                <select id="uzmanSelect" name="uzman_id" class="form-control" required>
                    @php
                        $uzman = \App\Models\User::find($randevu->uzman_id);
                    @endphp
                    <option value="{{ $uzman->id }}">{{ $uzman->ad }} {{ $uzman->soyad }} ({{ $uzman->email }})</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-submit mt-3">Güncelle</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('sehirSelect').addEventListener('change', function () {
        const sehir = this.value;
        const uzmanSelect = document.getElementById('uzmanSelect');

        uzmanSelect.innerHTML = '<option>Yükleniyor...</option>';

        fetch(`/admin/uzmanlar/${sehir}`)
            .then(res => res.json())
            .then(data => {
                uzmanSelect.innerHTML = '<option value="">Uzman Seçiniz</option>';
                data.forEach(function (uzman) {
                    uzmanSelect.innerHTML += `<option value="${uzman.id}">${uzman.ad} ${uzman.soyad} (${uzman.email})</option>`;
                });
            });
    });
</script>
@endsection

