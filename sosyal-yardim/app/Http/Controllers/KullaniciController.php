<?php

namespace App\Http\Controllers;

use App\Models\Randevu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KullaniciController extends Controller
{
    public function index()
    {
        return view('kullanici.index');
    }

    public function profil()
    {
        $user = Auth::user();
        return view('kullanici.profil', compact('user'));
    }

    public function profilGuncelle(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'ad' => 'required|string|max:100',
            'soyad' => 'nullable|string|max:100',
            'email' => 'required|email',
            'telefon' => 'nullable|string|max:20',
            'sehir' => 'nullable|string|max:100',
            'profil_resmi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->ad = $request->ad;
        $user->soyad = $request->soyad;
        $user->email = $request->email;
        $user->telefon = $request->telefon;
        $user->sehir = $request->sehir;

        if ($request->hasFile('profil_resmi')) {
            // eski foto varsa sil
            if ($user->profil_resmi && Storage::exists('public/' . $user->profil_resmi)) {
                Storage::delete('public/' . $user->profil_resmi);
            }

            $path = $request->file('profil_resmi')->store('profil_fotolari', 'public');
            $user->profil_resmi = $path;
        }

        $user->save();

        return back()->with('success', '✅ Profil başarıyla güncellendi.');
    }

    public function sifreForm()
    {
        return view('kullanici.sifreguncelle');
    }

    public function sifreGuncelle(Request $request)
    {
        $request->validate([
            'mevcut_sifre' => 'required',
            'yeni_sifre' => 'required|min:8|same:yeni_sifre_tekrar',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->mevcut_sifre, $user->password)) {
            return back()->withErrors(['mevcut_sifre' => '❌ Mevcut şifre hatalı.']);
        }

        $user->password = Hash::make($request->yeni_sifre);
        $user->save();

        return back()->with('success', '✅ Şifreniz başarıyla değiştirildi.');
    }

    public function create()
    {
        return view('kullanici.randevular.randevu_al');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ad' => 'required|string|max:50',
            'soyad' => 'required|string|max:50',
            'email' => 'required|email',
            'telefon' => 'required|regex:/^[0-9]{10,11}$/',
            'randevu_turu' => 'required|array',
            'tarih' => 'required|date',
            'saat' => 'required|date_format:H:i',
            'aciklama' => 'nullable|string|max:50',
            'sehir' => 'required|string|max:100',
            'uzman' => 'required|string|max:100',
            'uzman_id' => 'required|numeric'
        ]);

        $varMi = Randevu::where('tarih', $request->tarih)
            ->where('saat', $request->saat)
            ->where('uzman_id', $request->uzman_id)
            ->exists();

        if ($varMi) {
            return back()->withErrors(['saat' => '❌ Bu saatte uzmanın başka randevusu var.'])->withInput();
        }

        Randevu::create([
            'user_id' => Auth::id(),
            'ad' => $request->ad,
            'soyad' => $request->soyad,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'randevu_turu' => implode(', ', $request->randevu_turu),
            'tarih' => $request->tarih,
            'saat' => $request->saat,
            'aciklama' => $request->aciklama,
            'sehir' => $request->sehir,
            'uzman' => $request->uzman,
            'uzman_id' => $request->uzman_id
        ]);

        return redirect()->route('kullanici.randevular.bekleyen')->with('success', '✅ Randevu başarıyla oluşturuldu.');
    }

    public function bekleyen()
    {
        $randevular = Randevu::where('user_id', Auth::id())
            ->whereDate('tarih', '>=', now()->toDateString())
            ->orderBy('tarih')
            ->get();

        return view('kullanici.randevular.bekleyen', compact('randevular'));
    }

    public function gecmis()
    {
        $randevular = Randevu::where('user_id', Auth::id())
            ->whereDate('tarih', '<', now()->toDateString())
            ->orderByDesc('tarih')
            ->get();

        return view('kullanici.randevular.gecmis', compact('randevular'));
    }

    public function duzenle($id)
    {
        $randevu = Randevu::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('kullanici.randevular.duzenle', compact('randevu'));
    }

    public function guncelle(Request $request, $id)
    {
        $randevu = Randevu::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'ad' => 'required|string|max:50',
            'soyad' => 'required|string|max:50',
            'email' => 'required|email',
            'telefon' => 'required|regex:/^[0-9]{10,11}$/',
            'randevu_turu' => 'required|array',
            'tarih' => 'required|date',
            'saat' => 'required|date_format:H:i',
            'aciklama' => 'nullable|string|max:50',
            'sehir' => 'required|string|max:100',
            'uzman' => 'required|string|max:100',
            'uzman_id' => 'required|numeric'
        ]);

        $varMi = Randevu::where('id', '!=', $randevu->id)
            ->where('tarih', $request->tarih)
            ->where('saat', $request->saat)
            ->where('uzman_id', $request->uzman_id)
            ->exists();

        if ($varMi) {
            return back()->withErrors(['saat' => '❌ Bu uzmanın bu saatte başka randevusu var.'])->withInput();
        }

        $randevu->update([
            'ad' => $request->ad,
            'soyad' => $request->soyad,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'randevu_turu' => implode(', ', $request->randevu_turu),
            'tarih' => $request->tarih,
            'saat' => $request->saat,
            'aciklama' => $request->aciklama,
            'sehir' => $request->sehir,
            'uzman' => $request->uzman,
            'uzman_id' => $request->uzman_id
        ]);

        return redirect()->route('kullanici.randevular.bekleyen')->with('success', '✅ Randevu güncellendi.');
    }

    public function sil($id)
    {
        $randevu = Randevu::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $randevu->delete();

        return redirect()->route('kullanici.randevular.bekleyen')->with('success', '🗑️ Randevu silindi.');
    }
}



