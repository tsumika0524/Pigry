<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightTargetRequest;
use App\Models\WeightTarget;
use Illuminate\Http\Request;


class WeightTargetController extends Controller
{
    public function edit()
    {
        return view('weight_logs.edit');
    }

    public function update(WeightTargetRequest $request)
{
    $weightTarget = WeightTarget::find(1);

    $weightTarget->target_weight = $request->target_weight;
    $weightTarget->save();

    return redirect()->route('weight_logs.index');
}
}