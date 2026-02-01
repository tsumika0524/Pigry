@extends('layouts.guest')

@section('title', '新規会員登録')

@section('content')
<h1 class="logo">PiGLy</h1>
<p class="subtitle">新規会員登録</p>
<p class="step">STEP1 体重データの入力</p>

<form method="POST" action="/register/step2">
  @csrf
  <label>現在の体重</label>
  <div class="input-unit">
  <input type="text" name="current_weight"
    value="{{ old('current_weight') }}" placeholder="現在の体重を入力">
  <span class="unit">kg</span>
  </div>
   @error('current_weight')
  <p class="error">{{ $message }}</p>
   @enderror

  <label>目標の体重</label>
  <div class="input-unit">
  <input type="text" name="target_weight"
    value="{{ old('target_weight') }}" placeholder="目標の体重を入力">
  <span class="unit">kg</span>
  </div>
  @error('target_weight')
  <p class="error">{{ $message }}</p>
  @enderror


  <button class="btn">アカウント作成</button>
</form>
@endsection
