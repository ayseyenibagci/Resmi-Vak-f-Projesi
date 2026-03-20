<x-guest-layout>
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-box {
            background-color: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            margin: 60px auto;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .register-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #cf4c4c;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ccc;
            border-radius: 18px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background-color: #cf4c4c;
            color: white;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 18px;
            transition: transform 0.3s ease;
        }

        .register-btn:hover {
            transform: scale(1.03);
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 0.9rem;
            color: #cc0000;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .error {
            background-color: #ffecec;
            color: #cc0000;
            font-size: 0.95rem;
            padding: 10px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>

    <div class="register-box">
        <div class="register-title">Kayıt Ol</div>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="ad" class="form-control" placeholder="Ad" value="{{ old('ad') }}" required>
            <input type="text" name="soyad" class="form-control" placeholder="Soyad" value="{{ old('soyad') }}" required>
            <input type="text"
                    name="telefon"
                    class="form-control"
                    placeholder="Telefon (5xxxxxxxxx)"
                    value="{{ old('telefon') }}"
                    required
                    maxlength="10"
                    minlength="10"
                    pattern="\d{10}"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">


            <select name="sehir" class="form-control" required>
                <option value="">Şehir Seçiniz</option>
                @php
                    $iller = ['Adana','Adıyaman','Afyonkarahisar','Ağrı','Aksaray','Amasya','Ankara','Antalya','Artvin','Aydın','Balıkesir','Bartın','Batman','Bayburt','Bilecik','Bingöl','Bitlis','Bolu','Burdur','Bursa','Çanakkale','Çankırı','Çorum','Denizli','Diyarbakır','Düzce','Edirne','Elazığ','Erzincan','Erzurum','Eskişehir','Gaziantep','Giresun','Gümüşhane','Hakkâri','Hatay','Iğdır','Isparta','İstanbul','İzmir','Kahramanmaraş','Karabük','Karaman','Kars','Kastamonu','Kayseri','Kırıkkale','Kırklareli','Kırşehir','Kilis','Kocaeli','Konya','Kütahya','Malatya','Manisa','Mardin','Mersin','Muğla','Muş','Nevşehir','Niğde','Ordu','Osmaniye','Rize','Sakarya','Samsun','Şanlıurfa','Siirt','Sinop','Şırnak','Sivas','Tekirdağ','Tokat','Trabzon','Tunceli','Uşak','Van','Yalova','Yozgat','Zonguldak'];
                @endphp
                @foreach ($iller as $il)
                    <option value="{{ $il }}" {{ old('sehir') == $il ? 'selected' : '' }}>{{ $il }}</option>
                @endforeach
            </select>

            <input type="email" name="email" class="form-control" placeholder="E-posta" value="{{ old('email') }}" required>

            <small style="color: #888; font-size: 0.9rem; display:block; margin-bottom: 8px;">
                Şifre en az 8 karakter olmalı, büyük ve küçük harf içermelidir.
            </small>
            <input type="password" name="password" class="form-control" placeholder="Şifre" required>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Şifre (Tekrar)" required>

            <button type="submit" class="register-btn">Kayıt Ol</button>

            <a href="{{ route('login') }}" class="register-link">Zaten hesabınız var mı?</a>
        </form>
    </div>
</x-guest-layout>






