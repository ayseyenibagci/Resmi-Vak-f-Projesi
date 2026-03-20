<x-guest-layout>
    <style>
        body {
            background-color: #f5f7fa;
        }

        .form-wrapper {
            background-color: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
        }

        h2 {
            color: #002F6C;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 20px;
        }

        .alert {
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>

    <div class="form-wrapper">
        <h2>📧 E-posta Doğrulama Gerekli</h2>

        <p>
            Lütfen devam etmeden önce e-posta adresinizi doğrulamak için e-postanızı kontrol edin.
            Eğer doğrulama e-postası almadıysanız, aşağıdaki butona tıklayarak tekrar gönderebilirsiniz.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success text-success">
                ✅ Yeni bir doğrulama bağlantısı e-posta adresinize gönderildi.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">📨 Doğrulama E-postasını Tekrar Gönder</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-secondary">🚪 Çıkış Yap</button>
        </form>
    </div>
</x-guest-layout>

