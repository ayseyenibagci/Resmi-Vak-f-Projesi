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
            background-color: #6c63ff;
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
    </style>

    <div class="form-wrapper">
        <h2>Şifreyi Sıfırla</h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <input id="email" type="email" name="email" placeholder="E-posta" :value="old('email', $request->email)" required autofocus />

            <input id="password" type="password" name="password" placeholder="Yeni Şifre" required />

            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Yeni Şifre (Tekrar)" required />

            <button type="submit" class="btn">Şifreyi Sıfırla</button>
        </form>
    </div>
</x-guest-layout>

