@php
    $user = Auth::user();
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand vakif-logo d-flex align-items-center gap-2" href="{{ route('anasayfa') }}">
            <img src="{{ asset('images/logo.png') }}" alt="SAY VAKFI" width="50" class="rounded-circle me-2 shadow-sm">
            <span class="fw-bold text-white fst-italic">SAY VAKFI</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav align-items-center">

                @guest
                    <!-- Anasayfa ve Giriş menüleri -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('anasayfa') ? 'active' : '' }}" href="{{ route('anasayfa') }}">
                            <img src="{{ asset('images/anasayfa.png') }}" class="nav-icon me-2"> Anasayfa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('yardimlarimiz') ? 'active' : '' }}" href="{{ route('yardimlarimiz') }}">
                            <img src="{{ asset('images/yardımlarımız.png') }}" class="nav-icon me-2"> Yardımlarımız
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ekibimiz') ? 'active' : '' }}" href="{{ route('ekibimiz') }}">
                            <img src="{{ asset('images/ekibimiz.png') }}" class="nav-icon me-2"> Ekibimiz
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <img src="{{ asset('images/girisyap.png') }}" class="nav-icon me-2"> Giriş Yap
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <img src="{{ asset('images/kayıtol.png') }}" class="nav-icon me-2"> Kayıt Ol
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-warning" href="#" role="button" data-bs-toggle="dropdown">
                            {{ $user->ad }} {{ $user->soyad }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            @if($user->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">🛠️ Admin Paneli</a>
                                </li>
                            @elseif($user->role === 'uzman')
                                <li>
                                    <a class="dropdown-item" href="{{ route('uzman.index') }}">👨‍⚕️ Uzman Paneli</a>
                                </li>
                            @elseif($user->role === 'user')
                                <li>
                                    <a class="dropdown-item" href="{{ route('kullanici.index') }}">👤 Kullanıcı Paneli</a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        🔓 Çıkış Yap
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
