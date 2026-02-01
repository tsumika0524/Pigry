<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1) user 1件
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // 2) weight_logs 35件（userに紐づく）
        WeightLog::factory()
            ->count(35)
            ->create([
                'user_id' => $user->id,
            ]);

        // 3) weight_target 1件（userに紐づく）
        WeightTarget::factory()
            ->create([
                'user_id' => $user->id,
                'target_weight' => 60.0, // 任意（固定にしてもOK）
            ]);
    }
}
