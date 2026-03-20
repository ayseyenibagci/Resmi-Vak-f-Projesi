<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RandevuController;
use App\Http\Controllers\UzmanController;
use App\Http\Controllers\KullaniciController;
use App\Models\Randevu;

// Anasayfa yönlendirmesi
Route::get('/', fn() => redirect()->route('anasayfa'));

// Dolu saatleri getir
Route::get('/dolu-saatler/{tarih}', function ($tarih) {
    return Randevu::where('tarih', $tarih)->pluck('saat');
});

// Auth rotalarını dahil et
require __DIR__.'/auth.php';

// Genel sayfalar
Route::get('/anasayfa', fn() => view('anasayfa'))->name('anasayfa');
Route::get('/yardimlarimiz', fn() => view('yardimlarimiz'))->name('yardimlarimiz');
Route::get('/ekibimiz', fn() => view('ekibimiz'))->name('ekibimiz');

// E-posta doğrulama rotaları
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Doğrulama e-postası tekrar gönderildi.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Dashboard yönlendirmesi
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) return redirect('/login');

    if ($user->email === 'ayseyenibagci8@gmail.com') return redirect()->route('admin.dashboard');
    if ($user->role === 'uzman') return redirect()->route('uzman.index');
    if ($user->role === 'user') return redirect()->route('kullanici.index');

    abort(403, 'Yetkisiz erişim');
})->middleware(['auth', 'verified'])->name('dashboard');

// Giriş yaptıktan sonra yetkili rotalar
Route::middleware(['auth', 'verified'])->group(function () {

    // Admin paneli
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/kullanicilar', [AdminController::class, 'kullanicilar'])->name('admin.kullanicilar');
        Route::post('/kullanicilar/ekle', [AdminController::class, 'kullaniciEkle'])->name('admin.kullanicilar.ekle');
        Route::get('/kullanicilar/{id}/duzenle', [AdminController::class, 'kullaniciDuzenle'])->name('admin.kullanicilar.duzenle');
        Route::put('/kullanicilar/{id}', [AdminController::class, 'kullaniciGuncelle'])->name('admin.kullanicilar.guncelle');
        Route::delete('/kullanicilar/{id}', [AdminController::class, 'kullaniciSil'])->name('admin.kullanicilar.sil');

        Route::get('/randevular/{tip?}', [RandevuController::class, 'index'])->name('admin.randevular');
        Route::get('/randevular/create', [RandevuController::class, 'create'])->name('admin.randevular.create');
        Route::post('/randevular', [RandevuController::class, 'store'])->name('admin.randevular.store');
        Route::get('/randevular/{id}/edit', [RandevuController::class, 'edit'])->name('admin.randevular.edit');
        Route::put('/randevular/{id}', [RandevuController::class, 'update'])->name('admin.randevular.update');
        Route::delete('/randevular/{id}', [RandevuController::class, 'destroy'])->name('admin.randevular.destroy');

        Route::get('/uzmanlar/{sehir}', [AdminController::class, 'getUzmanlarBySehir']);

        Route::prefix('ayarlar')->group(function () {
            Route::get('/profil', [AdminController::class, 'profilForm'])->name('admin.ayarlar.profil');
            Route::post('/profil', [AdminController::class, 'profilGuncelle'])->name('admin.ayarlar.profil.guncelle');
            Route::get('/sifre', [AdminController::class, 'sifreForm'])->name('admin.ayarlar.sifre');
            Route::post('/sifre', [AdminController::class, 'sifreGuncelle'])->name('admin.ayarlar.sifre.guncelle');
        });
    });

    // Kullanıcı paneli
    Route::prefix('kullanici')->name('kullanici.')->group(function () {
        Route::get('/', [KullaniciController::class, 'index'])->name('index');
        Route::get('/profil', [KullaniciController::class, 'profil'])->name('profil');
        Route::post('/profil', [KullaniciController::class, 'profilGuncelle'])->name('profil.guncelle');
        Route::get('/sifre', [KullaniciController::class, 'sifreForm'])->name('sifre.form');
        Route::post('/sifre-guncelle', [KullaniciController::class, 'sifreGuncelle'])->name('sifre.guncelle');

        Route::get('/randevular/bekleyen', [KullaniciController::class, 'bekleyen'])->name('randevular.bekleyen');
        Route::get('/randevular/gecmis', [KullaniciController::class, 'gecmis'])->name('randevular.gecmis');
        Route::get('/randevu/al', [KullaniciController::class, 'create'])->name('randevu.al');
        Route::post('/randevu/kaydet', [KullaniciController::class, 'store'])->name('randevu.kaydet');
        Route::get('/randevu/{id}/duzenle', [KullaniciController::class, 'duzenle'])->name('randevu.duzenle');
        Route::put('/randevu/{id}', [KullaniciController::class, 'guncelle'])->name('randevu.guncelle');
        Route::delete('/randevu/{id}', [KullaniciController::class, 'sil'])->name('randevu.sil');
    });

    // Uzman paneli
    Route::prefix('uzman')->name('uzman.')->group(function () {
        Route::get('/', [UzmanController::class, 'index'])->name('index');
        Route::get('/randevular/bekleyen', [UzmanController::class, 'bekleyen'])->name('randevular.bekleyen');
        Route::get('/randevular/gecmis', [UzmanController::class, 'gecmis'])->name('randevular.gecmis');
        Route::get('/profil', [UzmanController::class, 'profil'])->name('profil');
        Route::post('/profil', [UzmanController::class, 'profilGuncelle'])->name('profil.guncelle');
        Route::get('/sifre', [UzmanController::class, 'sifreForm'])->name('sifre.form');
        Route::post('/sifre-guncelle', [UzmanController::class, 'sifreGuncelle'])->name('sifre.guncelle');
    });

    // Ajax ile şehir bazlı uzman getir
    Route::get('/uzmanlar/{sehir}', [RandevuController::class, 'getUzmanlar']);
});
