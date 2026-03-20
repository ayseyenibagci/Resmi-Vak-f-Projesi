@extends('layouts.app')

@section('content')
<style>
    .popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .popup-content {
        background-color: white;
        padding: 30px 40px;
        border-radius: 20px;
        text-align: center;
        max-width: 400px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        position: relative;
    }

    .popup-content h3 {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .popup-content button {
        padding: 10px 20px;
        border: none;
        border-radius: 15px;
        background-color: #4c8dcf;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    .popup-close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
        color: #666;
    }

    .yardim-kart {
        background-color: #ffffff;
        border-radius: 18px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.05);
        padding: 20px;
        transition: all 0.3s ease;
        height: 100%;
    }

    .yardim-kart:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.07);
    }

    .yardim-kart img {
        width: 100%;
        border-radius: 12px;
        max-height: 180px;
        object-fit: cover;
    }

    .yardim-baslik {
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .yardim-aciklama {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 15px;
    }

    .bagis-kutusu-ana {
        background-color: #eef6ff;
        border: 2px solid #93989c;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-top: 50px;
        padding: 30px;
    }

    .bagis-kutusu-ana:hover {
        background-color: #dbeeff;
        transform: translateY(-3px);
    }

    .bagis-resmi-yuvarlak {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #4c8dcf;
    }
</style>

<div id="anasayfaPopup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="popup-close" onclick="kapatPopup()">&times;</span>
        <h3>Randevu almak için lütfen giriş yapınız</h3>
        <button onclick="kapatPopup()">Tamam</button>
    </div>
</div>

<script>
    function kapatPopup() {
        document.getElementById('anasayfaPopup').style.display = 'none';
        sessionStorage.setItem('popupGosterildi', 'evet');
    }

    window.addEventListener('load', function() {
        if (!sessionStorage.getItem('popupGosterildi')) {
            document.getElementById('anasayfaPopup').style.display = 'flex';
        }
    });
</script>

<div class="container my-5">
    <h2 class="text-center fw-bold mb-5">Randevu Kapsamında Verdiğimiz Yardımlarımız</h2>

    @php
        $yardimlar = [
            ['emoji' => '🧠', 'baslik' => 'Psikolojik Destek', 'aciklama' => 'Ruhsal zorluklar yaşayan bireyler için psikolojik danışmanlık, travma terapileri ve bireysel görüşmeler sağlanır.', 'resim' => 'psikolojik.png'],
            ['emoji' => '💸', 'baslik' => 'Maddi Yardım', 'aciklama' => 'Fatura desteği, acil nakdi yardım ve ekonomik yoksunluk yaşayan bireyler için kısa vadeli finansal destek sunulmaktadır.', 'resim' => 'maddi.png'],
            ['emoji' => '🎓', 'baslik' => 'Eğitim Desteği', 'aciklama' => 'Öğrencilere burs, kırtasiye, özel ders desteği ve sınav hazırlık süreçlerinde rehberlik sağlanmaktadır.', 'resim' => 'eğitim.png'],
            ['emoji' => '⚖️', 'baslik' => 'Hukuki Danışmanlık', 'aciklama' => 'Hukuki sorunlar yaşayan bireylerin bilgilendirilmesi, yönlendirilmesi ve gerektiğinde ücretsiz avukat desteği sağlanır.', 'resim' => 'hukuki.png'],
            ['emoji' => '🏠', 'baslik' => 'Barınma Yardımı', 'aciklama' => 'Ev bulamayan veya evinden ayrılmak zorunda kalan bireylere geçici barınma, yurt veya kira desteği sunulmaktadır.', 'resim' => 'barınma.png'],
            ['emoji' => '🩺', 'baslik' => 'Sağlık Hizmeti', 'aciklama' => 'Tıbbi muayene, ilaç desteği, hastane yönlendirmesi ve medikal ekipman sağlanarak sağlık hizmetlerine erişim desteklenir.', 'resim' => 'sağlık.png'],
            ['emoji' => '🍞', 'baslik' => 'Gıda Yardımı', 'aciklama' => 'Kumanya, sıcak yemek, market kartı veya temel gıda malzemeleri yardımı ile gıda güvenliği sağlanır.', 'resim' => 'gıda.png'],
            ['emoji' => '👔', 'baslik' => 'İstihdam Danışmanlığı', 'aciklama' => 'İş arayan bireylere özgeçmiş hazırlama, kariyer yönlendirme ve iş görüşmesine hazırlık desteği verilmektedir.', 'resim' => 'istihdam.png'],
            ['emoji' => '🗣️', 'baslik' => 'Sosyal Hizmet Görüşmesi', 'aciklama' => 'İhtiyaç analizi ve bireysel sosyal hizmet planlaması için uzman sosyal hizmet uzmanlarımızla birebir görüşme yapılır.', 'resim' => 'sosyalgörüşme.png'],
            ['emoji' => '📌', 'baslik' => 'Diğer', 'aciklama' => 'Yukarıdaki kategorilere girmeyen özel ihtiyaçlar için bireysel değerlendirme yapılır ve ilgili yönlendirmeler sağlanır.', 'resim' => 'diğer.png'],
        ];
    @endphp

    <div class="row g-4">
        @foreach ($yardimlar as $yardim)
        <div class="col-md-6">
            <div class="yardim-kart h-100">
                <div class="yardim-baslik">
                    <span>{{ $yardim['emoji'] }}</span> {{ $yardim['baslik'] }}
                </div>
                <p class="yardim-aciklama">{{ $yardim['aciklama'] }}</p>
                <img src="{{ asset('images/' . $yardim['resim']) }}" alt="{{ $yardim['baslik'] }}">
            </div>
        </div>
        @endforeach
    </div>
</div>


<div class="container my-5">
    <div class="row">
        <div class="col-md-20 mx-auto">

            <div class="bagis-kutusu-ana d-flex align-items-center">
                <img src="{{ asset('images/berru.png') }}" alt="Bağış" class="bagis-resmi-yuvarlak me-4">
                <div>
                    <h5 class="fw-bold mb-2">DESTEK OLUN</h5>
                    <p class="mb-0">
                        Yardımlarımızın sürdürülebilirliği için bağışta bulunmak isterseniz bağış uzmanımız olan<br>
                        Berru Havin Karabulut ile bu <strong>05000000000</strong> numaradan iletişime geçebilirsiniz.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
