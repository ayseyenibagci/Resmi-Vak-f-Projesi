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
    .saat-kutulari {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-top: 12px;
    }
    .saat-item {
        background-color: #fff;
        border: 2px solid #002F6C;
        border-radius: 12px;
        padding: 14px 0;
        text-align: center;
        font-weight: bold;
        color: #002F6C;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.05);
        user-select: none;
    }
    .saat-item:hover:not(.dolu):not(.active) {
        background-color: #e6f0ff;
        transform: scale(1.05);
    }
    .saat-item.active {
        background-color: #002F6C;
        color: white;
    }
    .saat-item.dolu {
        background-color: #ff4d4d;
        border-color: #ff4d4d;
        color: white;
        cursor: not-allowed;
        opacity: 0.7;
    }
    body {
        background-color: #f7f9fc;
    }
    .randevu-form-wrapper {
        max-width: 700px;
        margin: 60px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
    }
    .randevu-form h2 {
        text-align: center;
        font-weight: bold;
        font-size: 28px;
        color: #002F6C;
        margin-bottom: 30px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #333;
    }
    .form-control {
        width: 100%;
        padding: 12px 14px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 12px;
        background-color: #fdfdfd;
        transition: border-color 0.3s;
    }
    .form-check {
        margin-bottom: 10px;
    }
    .form-check-input {
        margin-right: 10px;
        transform: scale(1.2);
    }
    .btn-submit {
        background-color: #002F6C;
        color: white;
        font-weight: bold;
        font-size: 16px;
        padding: 12px 30px;
        border: none;
        border-radius: 12px;
        width: 100%;
        transition: background-color 0.3s;
    }
    .btn-submit:hover {
        background-color: #00418a;
    }
    textarea.form-control {
        resize: vertical;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="randevu-form-wrapper">
    <h2>📝 Randevu Al</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $hata)
                    <li>{{ $hata }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('kullanici.randevu.kaydet') }}">
        @csrf

        <div class="form-group">
            <label>Ad</label>
            <input type="text" name="ad" class="form-control" required value="{{ old('ad', auth()->user()->name) }}">
        </div>

        <div class="form-group">
            <label>Soyad</label>
            <input type="text" name="soyad" class="form-control" required value="{{ old('soyad') }}">
        </div>

        <div class="form-group">
            <label>E-posta</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', auth()->user()->email) }}">
        </div>

        <div class="form-group">
            <label>Telefon</label>
            <input type="text" name="telefon" class="form-control" required value="{{ old('telefon') }}">
        </div>

        <div class="form-group">
            <label>Randevu Türü</label>
            @php
                $turler = [
                    'Psikolojik Destek','Maddi Yardım','Eğitim Desteği','Hukuki Danışmanlık',
                    'Barınma Yardımı','Sağlık Hizmeti','Gıda Yardımı','İstihdam Danışmanlığı',
                    'Sosyal Hizmet Görüşmesi','Diğer'
                ];
            @endphp
            @foreach($turler as $index => $tur)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="randevu_turu[]" value="{{ $tur }}" id="tur{{ $index }}">
                    <label class="form-check-label" for="tur{{ $index }}">{{ $tur }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Şehir</label>
            <select id="sehirSelect" name="sehir" class="form-control" required>
                <option value="">Şehir seçiniz</option>
                @php
                    $iller = \App\Models\User::where('role', 'uzman')->distinct()->pluck('sehir');
                @endphp
                @foreach($iller as $il)
                    <option value="{{ $il }}" {{ old('sehir') == $il ? 'selected' : '' }}>{{ $il }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Uzman</label>
            <select id="uzmanSelect" class="form-control" required>
                <option value="">Önce şehir seçiniz</option>
            </select>
            <input type="hidden" name="uzman" id="uzmanHidden">
            <input type="hidden" name="uzman_id" id="uzmanIdHidden">
        </div>

        <div class="form-group">
            <label>Tarih</label>
            <input type="date" name="tarih" id="tarihInput" class="form-control" required value="{{ old('tarih') }}">
        </div>

        <div class="form-group">
            <label for="saat">Saat Seçiniz</label>
            <div id="saatKutulari" class="saat-kutulari"></div>
            <input type="hidden" name="saat" id="saatInput" value="{{ old('saat') }}">
        </div>

        <div class="form-group">
            <label>Açıklama (max 50 karakter)</label>
            <textarea name="aciklama" class="form-control" rows="3" maxlength="50" oninput="karakterSay()">{{ old('aciklama') }}</textarea>
            <small id="karakterSayac" class="text-muted">0 / 50 karakter</small>
        </div>

        <button type="submit" class="btn btn-submit mt-3">Randevu Al</button>
    </form>
</div>

<script>
function karakterSay() {
    const textarea = document.querySelector('textarea[name="aciklama"]');
    const sayac = document.getElementById('karakterSayac');
    sayac.textContent = `${textarea.value.length} / 50 karakter`;
}

function saatleriGetir(tarih) {
    fetch(`{{ url('') }}/dolu-saatler/${encodeURIComponent(tarih)}`)
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
    const baseUrl = "{{ url('') }}";

    const tarihInput = document.getElementById('tarihInput');
    const seciliTarih = tarihInput.value;
    if (seciliTarih) {
        saatleriGetir(seciliTarih);
    }

    tarihInput.addEventListener('change', function () {
        saatleriGetir(this.value);
    });

    karakterSay();

    const sehirSelect = document.getElementById('sehirSelect');
    const uzmanSelect = document.getElementById('uzmanSelect');
    const uzmanHidden = document.getElementById('uzmanHidden');
    const uzmanIdHidden = document.getElementById('uzmanIdHidden');

    sehirSelect.addEventListener('change', function () {
        const sehir = this.value;
        uzmanSelect.innerHTML = '<option value="">Yükleniyor...</option>';

        if (sehir) {
            fetch(`${baseUrl}/uzmanlar/${encodeURIComponent(sehir)}`)
                .then(res => {
                    if (!res.ok) throw new Error('Sunucu hatası');
                    return res.json();
                })
                .then(data => {
                    uzmanSelect.innerHTML = '<option value="">Uzman seçiniz</option>';
                    if (data.length === 0) {
                        uzmanSelect.innerHTML += '<option disabled>Uzman bulunamadı</option>';
                    } else {
                        data.forEach(uzman => {
                            const fullName = uzman.ad + ' ' + uzman.soyad;
                            uzmanSelect.innerHTML += `<option value="${uzman.id}" data-name="${fullName}">${fullName}</option>`;
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    uzmanSelect.innerHTML = '<option disabled>Hata oluştu</option>';
                });
        } else {
            uzmanSelect.innerHTML = '<option value="">Önce şehir seçiniz</option>';
        }
    });

    uzmanSelect.addEventListener('change', function () {
        const selected = uzmanSelect.options[uzmanSelect.selectedIndex];
        uzmanHidden.value = selected.getAttribute('data-name');
        uzmanIdHidden.value = selected.value;
    });
});
</script>
@endsection




