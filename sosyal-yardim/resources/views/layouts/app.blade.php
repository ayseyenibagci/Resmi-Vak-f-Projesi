<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sosyal Yardım Randevu Sistemi</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    {{-- Laravel Vite ile CSS ve JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Navigasyon menüsü --}}
    @include('layouts.navigation')

    {{-- Sayfa içeriği --}}
    <main class="flex-grow-1 py-4">
        @yield('content')
    </main>

    {{-- Footer varsa dahil et --}}
    @if(View::exists('layouts.footer'))
        @include('layouts.footer')
    @endif

</body>
</html>



















