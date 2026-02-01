<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // STEP1：ユーザー作成
    public function step1(RegisterStep1Request $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // user_idをsessionへ保存
        session(['register_user_id' => $user->id]);

        return redirect('/register/step2');
    }

    // STEP2画面表示
    public function showStep2()
    {
        if (!session()->has('register_user_id')) {
            return redirect('/register/step1');
        }

        return view('auth.register_step2');
    }

    // STEP2：weight_target + weight_logs 保存
    public function postStep2(RegisterStep2Request $request)
    {
        $userId = session('register_user_id');

        if (!$userId) {
            return redirect('/register/step1');
        }

        $step2 = $request->validated();

        // 目標体重保存
        WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => $step2['target_weight'],
        ]);

        // 現在体重を最初のログとして保存
        WeightLog::create([
            'user_id' => $userId,
            'date' => now()->format('Y-m-d'),
            'weight' => $step2['current_weight'],
            'calories' => null,
            'exercise_time' => null,
            'exercise_content' => null,
        ]);

        session()->forget('register_user_id');

        return redirect('/login');
    }
}
