<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard');
    }

    public function kullanicilar(Request $request): View
    {
        $query = User::query()->where('email', '!=', 'ayseyenibagci8@gmail.com');

        if ($request->filled('arama')) {
            $arama = $request->arama;
            $query->where(function ($q) use ($arama) {
                $q->where('ad', 'like', "%{$arama}%")
                  ->orWhere('soyad', 'like', "%{$arama}%")
                  ->orWhere('email', 'like', "%{$arama}%");
            });
        }

        if ($request->filled('rol')) {
            $query->where('role', $request->rol);
        }

        $kullanicilar = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.kullanicilar', compact('kullanicilar'));
    }

    public function kullaniciEkle(Request $request): RedirectResponse
    {
        $request->validate([
            'ad' => 'required',
            'soyad' => 'required',
            'email' => 'required|email|unique:users,email',
            'telefon' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user,uzman',
            'sehir' => 'nullable',
        ]);

        User::create([
            'ad' => $request->ad,
            'soyad' => $request->soyad,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'sehir' => $request->sehir,
        ]);

        return back()->with('success', 'Kullanıcı başarıyla eklendi.');
    }

    public function kullaniciDuzenle($id): View
    {
        $user = User::findOrFail($id);
        return view('admin.kullanici.duzenle', compact('user'));
    }

    public function kullaniciGuncelle(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'ad' => 'required',
            'soyad' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefon' => 'required',
            'role' => 'required|in:admin,user,uzman',
            'sehir' => 'nullable',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.kullanicilar')->with('success', 'Güncelleme başarılı.');
    }

    public function kullaniciSil($id): RedirectResponse
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Kullanıcı silindi.');
    }

    public function profilForm(): View
    {
        return view('admin.ayarlar.profil', ['admin' => Auth::user()]);
    }

    public function profilGuncelle(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'ad' => 'required',
            'soyad' => 'nullable',
            'email' => 'required|email',
            'telefon' => 'nullable',
            'sehir' => 'nullable',
            'profil_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profil_foto')) {
            $dosya = $request->file('profil_foto');
            $dosyaAdi = time() . '_' . $dosya->getClientOriginalName();
            $dosya->move(public_path('uploads'), $dosyaAdi);
            $user->profil_foto = 'uploads/' . $dosyaAdi;
        }

        $user->update($request->only(['ad', 'soyad', 'email', 'telefon', 'sehir']));

        return back()->with('success', 'Profil güncellendi.');
    }

    public function sifreForm(): View
    {
        return view('admin.ayarlar.sifre');
    }

    public function sifreGuncelle(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mevcut şifre yanlış']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Şifre başarıyla değiştirildi.');
    }

    public function getUzmanlarBySehir($sehir)
    {
        return User::where('role', 'uzman')->where('sehir', $sehir)->get();
    }
}
