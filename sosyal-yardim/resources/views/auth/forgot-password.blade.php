<x-guest-layout>
    <style>
        body {
            background-color: #ffffff;
        }

        .form-wrapper {
            background-color: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            margin: 60px auto;
            text-align: center;
        }

        .form-wrapper h2 {
            background-color: #f4b400;
            display: inline-block;
            padding: 10px 25px;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 30px;
            color: white;
        }

        .form-wrapper input {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-wrapper .btn {
            padding: 12px 30px;
            background-color: #ddd;
            border: none;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-wrapper p {
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 25px;
        }
    </style>

    <div class="form-wrapper">
        <h2>Şifremi Unuttum</h2>

        <p>Şifre sıfırlama bağlantısı için lütfen e_posta adresinizi giriniz. </p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input id="email" type="email" name="email" placeholder="E-posta" :value="old('email')" required autofocus />

            <button type="submit" class="btn">Şifre Sıfırlama Bağlantısı Gönder</button>
        </form>
    </div>
</x-guest-layout>


