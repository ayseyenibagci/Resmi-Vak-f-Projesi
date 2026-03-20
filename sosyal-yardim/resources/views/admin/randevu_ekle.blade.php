@extends('layouts.app')

@section('content')
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
@endphp

<div class="container randevu-form-wrapper">
    <div class="randevu-form">
        <h2>📝 Yeni Randevu Ekle</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $hata)
                        <li>{{ $hata }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.randevular.store') }}">
            @csrf

            <div class="form-group">
                <label>Ad</label>
                <input type="text" name="ad" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Soyad</label>
                <input type="text" name="soyad" class="form-control" required>
            </div>

            <div class="form-group">
                <label>E-posta</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Telefon</label>
                <input type="text" name="telefon" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Randevu Türü</label>
                @foreach($turler as $index => $tur)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="randevu_turu[]" value="{{ $tur }}" id="tur{{ $index }}">
                        <label class="form-check-label" for="tur{{ $index }}">{{ $tur }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label>Tarih</label>
                <input type="date" name="tarih" class="form-control" id="tarihInput" required>
            </div>

            <div class="form-group">
                <label>Saat</label>
                <div id="saatKutulari" class="saat-kutulari"></div>
                <input type="hidden" name="saat" id="saatInput" value="">
            </div>

            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="aciklama" class="form-control" rows="4" maxlength="50"></textarea>
            </div>

            <div class="form-group">
                <label>Şehir Seç</label>
                <select id="sehirSelect" class="form-control" required>
                    <option value="">Şehir seçiniz</option>
                    @foreach($iller as $il)
                        <option value="{{ $il }}">{{ $il }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Uzman Seç</label>
                <select id="uzmanSelect" class="form-control" required>
                    <option value="">Önce şehir seçiniz</option>
                </select>
                <input type="hidden" name="uzman" id="uzmanHidden">
                <input type="hidden" name="uzman_id" id="uzmanIdHidden">
            </div>

            <button type="submit" class="btn btn-success btn-submit mt-3">Kaydet</button>
        </form>
    </div>
</div>

<script>
function saatleriGetir(tarih) {
    fetch(`/dolu-saatler/${tarih}`)
        .then(res => res.json())
        .then(doluSaatler => {
            const saatKutulari = document.getElementById('saatKutulari');
            const saatInput = document.getElementById('saatInput');
            const saatler = [
                "08:00", "08:30", "09:00", "09:30", "10:00", "10:30",
                "11:00", "11:30", "13:00", "13:30", "14:00", "14:30",
                "15:00", "15:30", "16:00", "16:30"
            ];

            saatKutulari.innerHTML = '';

            saatler.forEach(saat => {
                const div = document.createElement('div');
                div.classList.add('saat-item');
                if (doluSaatler.includes(saat)) {
                    div.classList.add('dolu');
                    div.textContent = saat;
                    div.style.pointerEvents = 'none';
                } else {
                    div.dataset.saat = saat;
                    div.textContent = saat;
                    div.addEventListener('click', () => {
                        document.querySelectorAll('.saat-item').forEach(item => item.classList.remove('active'));
                        div.classList.add('active');
                        saatInput.value = saat;
                    });
                }
                saatKutulari.appendChild(div);
            });
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const tarihInput = document.getElementById('tarihInput');
    tarihInput.addEventListener('change', function () {
        if (this.value) {
            saatleriGetir(this.value);
        }
    });

    const sehirSelect = document.getElementById('sehirSelect');
    const uzmanSelect = document.getElementById('uzmanSelect');
    const uzmanHidden = document.getElementById('uzmanHidden');
    const uzmanIdHidden = document.getElementById('uzmanIdHidden');

    sehirSelect.addEventListener('change', function () {
        const sehir = this.value;
        uzmanSelect.innerHTML = '<option>Yükleniyor...</option>';

        fetch(`/uzmanlar/${sehir}`)
            .then(res => res.json())
            .then(data => {
                uzmanSelect.innerHTML = '<option value="">Uzman seçiniz</option>';
                data.forEach(uzman => {
                    const fullName = `${uzman.ad} ${uzman.soyad}`;
                    uzmanSelect.innerHTML += `<option value="${uzman.id}" data-name="${fullName}">${fullName}</option>`;
                });
            })
            .catch(() => {
                uzmanSelect.innerHTML = '<option disabled>Hata oluştu</option>';
            });
    });

    uzmanSelect.addEventListener('change', function () {
        const selected = uzmanSelect.options[uzmanSelect.selectedIndex];
        uzmanHidden.value = selected.getAttribute('data-name');
        uzmanIdHidden.value = selected.value;
    });
});
</script>
@endsection

