@extends('layouts.admin')

@section('title', '目標体重設定')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="target-container">
  <div class="target-card">
    <h2 class="target-title">目標体重設定</h2>

    <form method="POST" action="{{ route('weight_target.update') }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <input
          type="text"
          name="target_weight"
          value="{{ old('target_weight', $targetWeight->target_weight ?? '') }}"
          class="target-input"
        >
        <span class="unit">kg</span>
      </div>

      {{-- エラーメッセージ --}}
      @error('target_weight')
        <p class="error-text">{{ $message }}</p>
      @enderror

      <div class="button-group">
        <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
        <button type="submit" class="btn-update">更新</button>
      </div>
    </form>
  </div>
</div>
@endsection
