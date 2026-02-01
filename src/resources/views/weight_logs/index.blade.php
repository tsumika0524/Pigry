@extends('layouts.admin')

@section('title', '体重管理')

@section('content')
<div class="summary">
    <div class="summary-card">
        <p class="label">目標体重</p>
        <p class="value">{{ number_format($targetWeight, 1) }} <span>kg</span></p>
    </div>
    <div class="summary-card">
        <p class="label">目標まで</p>
        <p class="value">{{ number_format($latestWeight - $targetWeight, 1) }} <span>kg</span></p>
    </div>
    <div class="summary-card">
        <p class="label">最新体重</p>
        <p class="value">{{ number_format($latestWeight, 1) }} <span>kg</span></p>
    </div>
</div>

<div class="card">
    <div class="table-header">
    <div class="filters">
    <form method="GET" action="{{ route('weight_logs.index') }}">
        <input type="date" name="from" value="{{ request('from') }}">
        <span>〜</span>
        <input type="date" name="to" value="{{ request('to') }}">

        <button class="btn-gray">検索</button>
        @if(request()->filled('from') || request()->filled('to'))
            <a href="{{ route('weight_logs.index') }}" class="btn-reset">リセット</a>
        @endif
    </form>
    @php
      $from = request('from');
      $to = request('to');

      $fromJa = $from ? \Carbon\Carbon::parse($from)->format('Y年n月j日') : null;
      $toJa   = $to   ? \Carbon\Carbon::parse($to)->format('Y年n月j日')   : null;
      @endphp
    <div class="result-count">
     @if($from || $to)
     {{ $fromJa ?? '---' }}~{{ $toJa ?? '---' }}の検索結果{{ $weightLogs->total() }}件
     @else
     全{{ $weightLogs->total() }}件
    @endif
   </div>

    </div>
        <button class="btn-gradient" onclick="openModal()">データ追加</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($weightLogs as $log)
             <tr>
             <td>{{ $log->date->format('Y/m/d') }}</td>
             <td>{{ number_format($log->weight, 1) }}kg</td>
             <td>{{ $log->calories }}cal</td>
             <td>{{ $log->exercise_time }}</td>
             <td class="edit">
             <a href="{{ route('weight_logs.show', $log->id) }}" class="edit-btn">✎</a>
             </td>
             </tr>
            @endforeach
        </tbody>
    </table>

<div class="pagination">
  {{ $weightLogs->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>


</div>
{{-- 体重登録モーダル --}}
<div class="modal-overlay" id="weightModal">
  <div class="modal-content">
    <h2>Weight Log</h2>

    <form method="POST" action="{{ route('weight_logs.store') }}">
      @csrf

      <label>日付 <span class="required">必須</span></label>
      <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}">
      @error('date')
      <p class="error">{{ $message }}</p>
      @enderror

      <label>体重 <span class="required">必須</span></label>
      <div class="input-unit">
      <input type="number" step="0.1" name="weight" value="{{ old('weight') }}" placeholder="50.0">
      <span class="unit">kg</span>
      </div>
      @error('weight')
      <p class="error">{{ $message }}</p>
      @enderror

      <label>摂取カロリー <span class="required">必須</span></label>
      <div class="input-unit">
      <input type="number" name="calories" value="{{ old('calories') }}" placeholder="1200">
      <span class="unit">cal</span>
      </div>
      @error('calories')
      <p class="error">{{ $message }}</p>
      @enderror

      <label>運動時間 <span class="required">必須</span></label>
      <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
       @error('exercise_time')
       <p class="error">{{ $message }}</p>
       @enderror

      <label>運動内容</label>
      <textarea name="exercise_content" placeholder="運動内容を追加">@if(old('exercise_content')){{ old('exercise_content') }}@endif</textarea>
       @error('exercise_content')
       <p class="error">{{ $message }}</p>
       @enderror

      <div class="modal-buttons">
    <button type="button" class="btn-back" onclick="closeModal()">戻る</button>
    <button type="submit" class="btn-submit">登録</button>
    </div>
    </form>
  </div>
</div>
@endsection
@if ($errors->any())
<script>
  window.addEventListener('load', () => {
    openModal();
  });
</script>
@endif

