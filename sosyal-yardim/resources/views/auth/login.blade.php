<x-guest-layout>
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-box {
            background-color: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 420px;
            margin: 60px auto;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #cc0000;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ccc;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #cf4c4c;
            color: white;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 18px;
            transition: transform 0.3s, background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #cf4c4c;
            transform: scale(1.03);
        }

        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 12px;
            font-size: 0.9rem;
            color: #cc0000;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .error-box {
            background-color: #ffecec;
            color: #cc0000;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }
    </style>

    <div class="login-box">
        <div class="login-title">Giriş Yap</div>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

 
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" class="form-control" placeholder="E-posta adresiniz" required autofocus>

            <input type="password" name="password" class="form-control" placeholder="Şifreniz" required>

            <div class="checkbox-group">
                <input type="checkbox" name="remember" id="remember_me">
                <label for="remember_me" style="margin: 0;">Beni hatırla</label>
            </div>

            <button type="submit" class="login-btn">Giriş Yap</button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Şifrenizi mi unuttunuz?</a>
            @endif
        </form>
    </div>
</x-guest-layout>





