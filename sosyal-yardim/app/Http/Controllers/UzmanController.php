<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Randevu;
use Illuminate\Http\RedirectResponse;

class UzmanController extends Controller
{
    public function index()
    {
        return view('uzman.index');
    }

    public function bekleyen()
    {
        $randevular = Randevu::where('uzman_id', Auth::id())
            ->where('tarih', '>=', now()->toDateString())
            ->orderBy('tarih', 'asc')
            ->get();

        return view('uzman.randevular.bekleyen', compact('randevular'));
    }

    public function gecmis()
    {
        $randevular = Randevu::where('uzman_id', Auth::id())
            ->where('tarih', '<', now()->toDateString())
            ->orderBy('tarih', 'desc')
            ->get();

        return view('uzman.randevular.gecmis', compact('randevular'));
    }

    public function profil()
    {
        $user = Auth::user();
        return view('uzman.profil', compact('user'));
    }

    public function profilGuncelle(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'ad' => 'required|string|max:255',
            'soyad' => 'nullable|string|max:255',
            'email' => 'required|email',
            'telefon' => 'nullable|string|max:20',
            'sehir' => 'nullable|string|max:100',
            'profil_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profil_foto')) {
            $dosya = $request->file('profil_foto');
            $dosyaAdi = time() . '_' . $dosya->getClientOriginalName();
            $dosya->move(public_path('uploads'), $dosyaAdi);
            $user->profil_foto = 'uploads/' . $dosyaAdi;
        }

        $user->ad = $request->ad;
        $user->soyad = $request->soyad;
        $user->email = $request->email;
        $user->telefon = $request->telefon;
        $user->sehir = $request->sehir;
        $user->save();

        return back()->with('success', 'Profil başarıyla güncellendi.');
    }

    public function sifreForm()
    {
        return view('uzman.sifre');
    }

    public function sifreGuncelle(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mevcut şifre yanlış.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Şifre başarıyla güncellendi.');
    }
}

