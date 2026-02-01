<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // ここに来た時点でバリデーション済み

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()
                ->withErrors(['email' => 'メールアドレスまたはパスワードが正しくありません'])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('weight_logs.index');
    }
}
