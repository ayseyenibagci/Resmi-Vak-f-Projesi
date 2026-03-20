<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Kayıt formunu göster
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Yeni kullanıcıyı kaydet
     */
    public function store(Request $request)
    {
        $request->validate([
            'ad' => 'required|string|max:255',
            'soyad' => 'required|string|max:255',
            'telefon' => 'required|string|max:20',
            'sehir' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->letters(),
            ],
        ]);

        $user = User::create([
            'ad' => $request->ad,
            'soyad' => $request->soyad,
            'telefon' => $request->telefon,
            'sehir' => $request->sehir,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default rol
        ]);

        event(new Registered($user)); // ✉️ Doğrulama maili tetiklenir

        Auth::login($user); // Otomatik giriş

        return redirect()->route('verification.notice'); // Doğrulama sayfasına yönlendir
    }
}
