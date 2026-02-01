<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use Illuminate\Support\Facades\Route;


class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ログイン処理（Fortify標準）
        Fortify::authenticateUsing(function (FortifyLoginRequest $request) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return Auth::user();
            }
        });

        // ここは削除！
        // Fortify::redirects(...);
    }
}
