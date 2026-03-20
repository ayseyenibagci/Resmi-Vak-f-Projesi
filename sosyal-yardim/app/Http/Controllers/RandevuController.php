<?php

namespace App\Http\Controllers;

use App\Models\Randevu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RandevuController extends Controller
{
    public function index(Request $request, $tip = 'bekleyen')
    {
        $query = Randevu::query();

        $now = Carbon::now();
        $bugun = $now->format('Y-m-d');
        $saat = $now->format('H:i');

        if ($tip === 'gecmis') {
            $query->where(function ($q) use ($bugun, $saat) {
                $q->where('tarih', '<', $bugun)
                    ->orWhere(function ($q2) use ($bugun, $saat) {
                        $q2->where('tarih', $bugun)
                            ->where('saat', '<=', $saat);
                    });
            });
        } else {
            $query->where(function ($q) use ($bugun, $saat) {
                $q->where('tarih', '>', $bugun)
                    ->orWhere(function ($q2) use ($bugun, $saat) {
                        $q2->where('tarih', $bugun)
                            ->where('saat', '>', $saat);
                    });
            });
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qr) use ($q) {
                $qr->where('ad', 'like', "%$q%")
                    ->orWhere('soyad', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('telefon', 'like', "%$q%")
                    ->orWhere('randevu_turu', 'like', "%$q%")
                    ->orWhere('aciklama', 'like', "%$q%");
            });
        }

        if ($request->filled('tarih')) {
            $query->whereDate('tarih', $request->tarih);
        }

        $randevular = $query->orderBy('tarih')->orderBy('saat')->get();

        return view('admin.randevular', compact('randevular', 'tip'));
    }

    public function create()
    {
        return view('admin.randevular.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ad' => 'required|string|max:50',
            'soyad' => 'required|string|max:50',
            'email' => 'required|email',
            'telefon' => 'required|regex:/^[0-9]{10,11}$/',
            'randevu_turu' => 'required|array|min:1',
            'tarih' => 'required|date',
            'saat' => 'required|date_format:H:i',
            'aciklama' => 'nullable|string|max:50',
            'uzman_id' => 'required|exists:users,id'
        ]);

        $gun = Carbon::parse($request->tarih)->dayOfWeek;
        if ($gun === 0 || $gun === 6) {
            return back()->withErrors(['tarih' => '⚠️ Hafta sonu randevu alınamaz.'])->withInput();
        }

        if ($request->saat >= '12:00' && $request->saat < '13:00') {
            return back()->withErrors(['saat' => '⚠️ 12:00 - 13:00 arası mola saatidir.'])->withInput();
        }

        $randevuTuruStr = implode(', ', $request->randevu_turu);

        $uzman = User::find($request->uzman_id);
        $uzmanAdSoyad = $uzman ? $uzman->ad . ' ' . $uzman->soyad : null;

        Randevu::create([
            'user_id' => Auth::id(),
            'ad' => $request->ad,
            'soyad' => $request->soyad,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'randevu_turu' => $randevuTuruStr,
            'tarih' => $request->tarih,
            'saat' => $request->saat,
            'aciklama' => $request->aciklama,
            'uzman_id' => $request->uzman_id,
            'uzman' => $uzmanAdSoyad
        ]);

        return redirect()->route('admin.randevular')->with('success', '✅ Randevu başarıyla eklendi.');
    }

    public function edit($id)
    {
        $randevu = Randevu::findOrFail($id);
        return view('admin.randevu_duzenle', compact('randevu'));
    }

    public function update(Request $request, $id)
    {
        $randevu = Randevu::findOrFail($id);

        $request->validate([
            'ad' => 'required|string|max:50',
            'soyad' => 'required|string|max:50',
            'email' => 'required|email',
            'telefon' => 'required|regex:/^[0-9]{10,11}$/',
            'randevu_turu' => 'required|string|max:100',
            'tarih' => 'required|date',
            'saat' => 'required|date_format:H:i|after_or_equal:08:00|before_or_equal:17:00',
            'aciklama' => 'nullable|string|max:50',
            'uzman_id' => 'required|exists:users,id'
        ]);

        $uzman = User::find($request->uzman_id);
        $uzmanAdSoyad = $uzman ? $uzman->ad . ' ' . $uzman->soyad : null;

        $randevu->update([
            'ad' => $request->ad,
            'soyad' => $request->soyad,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'randevu_turu' => $request->randevu_turu,
            'tarih' => $request->tarih,
            'saat' => $request->saat,
            'aciklama' => $request->aciklama,
            'uzman_id' => $request->uzman_id,
            'uzman' => $uzmanAdSoyad
        ]);

        return redirect()->route('admin.randevular')->with('success', '✅ Randevu güncellendi.');
    }

    public function destroy($id)
    {
        $randevu = Randevu::findOrFail($id);
        $randevu->delete();
        return redirect()->route('admin.randevular')->with('success', '🗑️ Randevu silindi.');
    }

    public function getUzmanlar($sehir)
    {
        $uzmanlar = User::where('role', 'uzman')
            ->where('sehir', $sehir)
            ->select('id', 'ad', 'soyad')
            ->get();

        return response()->json($uzmanlar);
    }
}





