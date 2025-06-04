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

         Auth::login($user);

        // 4) Generiraj Sanctum token (plainTextToken)
        $token = $user->createToken('login-token')->plainTextToken;

        // 5) Vratimo token i podatke o korisniku
        return response()->json([
            'token' => $token,
            'user'  => $user,
        ], 200);
    }

    /**
     * Logout user (za API, ako želite).
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->currentAccessToken()->delete();
        }
        return response()->json(['message' => 'Uspješno ste se odjavili'], 200);
    
    }
}
