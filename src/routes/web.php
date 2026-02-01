<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| 会員登録（トップページ）
|--------------------------------------------------------------------------
*/
Route::get('/weight_logs', [WeightLogController::class, 'index']);

/*
|--------------------------------------------------------------------------
| ゲストのみ
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // STEP1表示
    Route::get('/register/step1', fn() => view('auth.register_step1'));

    // STEP1送信
    Route::post('/register/step1', [RegisterController::class, 'step1']);

    // STEP2表示
    Route::get('/register/step2', [RegisterController::class, 'showStep2']);

    // STEP2送信
    Route::post('/register/step2', [RegisterController::class, 'postStep2']);

    // ログイン
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

});


/*
|--------------------------------------------------------------------------
| ログイン必須
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/weight_logs/create', [WeightLogController::class, 'create']);
    Route::post('/weight_logs/create', [WeightLogController::class, 'store']);

    Route::get('/weight_logs', [WeightLogController::class, 'index'])
        ->name('weight_logs.index');

    // 詳細（編集画面表示）
    Route::get('/weight_logs/{weightLog}', [WeightLogController::class, 'show'])
        ->name('weight_logs.show');

    // 更新
    Route::post('/weight_logs/{weightLog}/update', [WeightLogController::class, 'update'])
        ->name('weight_logs.update');

    Route::get('/weight_target/edit', [WeightTargetController::class, 'edit'])
    ->name('weight_target.edit');

    Route::resource('weight_logs', WeightLogController::class);

    Route::get('/wight_logs/goal_setting', [WeightTargetController::class, 'edit'])
  ->name('weight_target.edit');

    Route::put('/wight_logs/goal_setting', [WeightTargetController::class, 'update'])
  ->name('weight_target.update');

    Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
     })->name('logout');
     
});

