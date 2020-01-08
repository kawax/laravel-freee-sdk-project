<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('freee-accounting')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('freee-accounting')->user();

        $loginUser = User::updateOrCreate(
            [
                'freee_id' => $user->id,
            ],
            [
                'name' => $user->name,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expired_at' => now()->addSeconds($user->expiresIn),
            ]
        );

        auth()->login($loginUser, true);

        return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->intended('/');
    }
}
