@extends('layouts.guest')

@section('title', 'ログイン')

@section('content')
<h1 class="logo">PiGLy</h1>
<p class="subtitle">ログイン</p>

<form method="POST" action="{{ route('login') }}" novalidate>
  @csrf

  <label>メールアドレス</label>
  <input type="text" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
  @error('email')
    <p class="error">{{ $message }}</p>
  @enderror

  <label>パスワード</label>
  <input type="password" name="password" placeholder="パスワードを入力">
  @error('password')
    <p class="error">{{ $message }}</p>
  @enderror

  <button class="btn">ログイン</button>
</form>

<a href="/register/step1" class="login-link">アカウント作成はこちら</a>
@endsection
