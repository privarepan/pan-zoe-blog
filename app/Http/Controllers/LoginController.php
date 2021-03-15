<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function githubView()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        if ($githubUser){
            $user = User::whereEmail($githubUser->getEmail())->first();
            if (!$user){
                $user = User::create([
                    'email' => $githubUser->getEmail(),
                    'name' => $githubUser->getName(),
                    'profile_photo_path' => $githubUser->getAvatar(),
                ]);
            }
            auth()->login($user);
            return app(LoginResponse::class);
        }
        return redirect('/')->with('error','授权失败');
    }
}
