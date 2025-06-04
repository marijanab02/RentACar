<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'google_id' => $googleUser->getId(),
                    'fname' => $googleUser->user['given_name'] ?? $googleUser->getName(),
                    'lname' => $googleUser->user['family_name'] ?? '',
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(rand(100000, 999999)), // Random password
                    'role'      => 'guest',
                    // Ako su ovi stupci NOT NULL, ili ih ostavimo barem prazne stringove:
                    'lic_num'   => '',
                    'phone_num' => '',
                    'gender'    => '',
                ]
            );

            // Update Google ID if user exists but didn't have it
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }

            Auth::login($user);

            // ** Ovdje dodaj generiranje API tokena (Sanctum / Passport / Personal Access Token) ** 
            $token = $user->createToken('google-token')->plainTextToken;

            // ** Redirect nazad na Vue app s tokenom u query parametru **
            return redirect()->away('http://localhost:5173/auth/callback?token='.$token);

        } catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect('/login')->withErrors('Google authentication failed');
        }
        Auth::login($user);
    
        // Create API token
        $token = $user->createTokenForOAuth();
        
        return redirect('/')->withCookie(cookie(
            'api_token', 
            $token,
            60 * 24 * 7, // 7 days
            null,
            null,
            false,
            true // HttpOnly
        ));
    }

}
