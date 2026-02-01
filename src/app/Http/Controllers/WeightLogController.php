<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{
    public function index(Request $request)
{
    $userId = auth()->id();

    // 体重ログ（検索対応）
    $query = WeightLog::where('user_id', $userId)
        ->orderBy('date', 'desc');

    if ($request->filled(['from', 'to'])) {
        $query->whereBetween('date', [
            $request->from,
            $request->to
        ]);
    }

    $weightLogs = $query->paginate(8)->appends($request->query());

    // ✅ 最新体重（検索条件に関係なく取得）
    $latestWeight = WeightLog::where('user_id', $userId)
        ->latest('date')
        ->value('weight');

    // ✅ 目標体重
    $targetWeight = WeightTarget::where('user_id', $userId)
        ->latest()
        ->value('target_weight');

    return view('weight_logs.index', compact(
        'weightLogs',
        'latestWeight',
        'targetWeight'
    ));
}

    public function store(StoreWeightLogRequest $request)
{
    $exercise = $request->exercise_time; // 例: "01:15"
    [$h, $m] = explode(':', $exercise);

     WeightLog::create([
    'user_id' => auth()->id(),
    'date' => $request->date,
    'weight' => $request->weight,
    'calories' => $request->calories,
    'exercise_time' => $request->exercise_time . ':00',
    'exercise_content' => $request->exercise_content,
]);


    return redirect()->route('weight_logs.index');
}


    public function show(WeightLog $weightLog)
    {
        return view('weight_logs.show', compact('weightLog'));
    }

    public function update(UpdateWeightLogRequest $request, WeightLog $weightLog)
    {
    [$h, $m] = explode(':', $request->exercise_time);

     $weightLog->update([
    'date' => $request->date,
    'weight' => $request->weight,
    'calories' => $request->calories,
    'exercise_time' => $request->exercise_time . ':00',
    'exercise_content' => $request->exercise_content,
     ]);


    return redirect()->route('weight_logs.index');
    }


    public function destroy($id)
    {
    WeightLog::findOrFail($id)->delete();

    return redirect()
        ->route('weight_logs.index')
        ->with('success', '削除しました');
    }
}
