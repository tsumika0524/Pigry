@extends('layouts.admin')

@section('title', '体重詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="edit-wrapper">
  <div class="edit-card">
    <h2>Weight Log</h2>

    {{-- 更新フォーム --}}
    <form method="POST"
          action="{{ route('weight_logs.update', $weightLog->id) }}">
      @csrf
      @method('PUT')

      {{-- 日付 --}}
      <label>日付</label>
      <input type="date" name="date"
        value="{{ old('date', $weightLog->date) }}">
      @error('date')
        <p class="error">{{ $message }}</p>
      @enderror

      {{-- 体重 --}}
      <label>体重</label>
      <div class="input-unit">
        <input type="number" step="0.1" name="weight"
          value="{{ old('weight', $weightLog->weight) }}">
        <span>kg</span>
      </div>
      @error('weight')
        <p class="error">{{ $message }}</p>
      @enderror

      {{-- 摂取カロリー --}}
      <label>摂取カロリー</label>
      <div class="input-unit">
        <input type="number" name="calories"
          value="{{ old('calories', $weightLog->calories) }}">
        <span>cal</span>
      </div>
      @error('calories')
        <p class="error">{{ $message }}</p>
      @enderror
      
      {{-- 運動時間 --}}
     @php
      // time型をHH:MMに整形
      $exerciseTime = optional($weightLog->exercise_time) ? \Carbon\Carbon::parse($weightLog->exercise_time)->format('H:i') : '';
     @endphp

    <label>運動時間</label>
     <input type="time" name="exercise_time"
       value="{{ old('exercise_time', $exerciseTime) }}">

     @error('exercise_time')
     <p class="error">{{ $message }}</p>
     @enderror


      {{-- 運動内容 --}}
      <label>運動内容</label>
      <textarea name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
      @error('exercise_content')
        <p class="error">{{ $message }}</p>
      @enderror

      {{-- ボタン --}}
      <div class="edit-buttons">
        <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>

        <button type="submit" class="btn-update">更新</button>

        <button
          type="button"
          class="btn-delete"
          onclick="if(confirm('削除しますか？')) document.getElementById('delete-form').submit();">
          🗑
        </button>
      </div>
    </form>

    {{-- 削除フォーム --}}
    <form id="delete-form"
          method="POST"
          action="{{ route('weight_logs.destroy', $weightLog->id) }}">
      @csrf
      @method('DELETE')
    </form>

  </div>
</div>
@endsection
