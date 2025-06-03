<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // napravi taj blade view
    }

    public function login(Request $request)
    {
        // Validiraj dolazne podatke
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Pokušaj prijavu
        if (! Auth::attempt($credentials)) {
            // Neispravni podaci -> 401
            throw ValidationException::withMessages([
                'email' => ['Neispravno korisničko ime ili lozinka.'],
            ]);
        }

        // Dohvati trenutno prijavljenog korisnika
        $user = Auth::user();

        // Ako želite koristiti token baziranu autentikaciju (npr. Laravel Sanctum ili Passport),
        // možete ovdje kreirati token i poslati ga. No u ovom primjeru ćemo nastaviti
        // s Basic Auth (Base64 email:password) kakav ste dosad koristili, pa token nećemo vraćati.
        //
        // U klijentu ćemo spremiti Base64(email:password) i slati ga u svakom sljedećem zahtjevu 
        // kao Basic Auth.

        return response()->json([
            'message' => 'Prištup odobren.',
            'user'    => $user,
        ], 200);
    }

    /**
     * Logout user (za API, ako želite).
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Odjavljeni ste.']);
    }
}
