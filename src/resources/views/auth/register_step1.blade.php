@extends('layouts.guest')

@section('title', '新規会員登録')

@section('content')
<h1 class="logo">PiGLy</h1>
<p class="subtitle">新規会員登録</p>
<p class="step">STEP1 アカウント情報の登録</p>

<form method="POST" action="/register/step1">
  @csrf

  <label>お名前</label>
  <input type="text" name="name" value="{{ old('name') }}" placeholder="名前を入力">
  @error('name')
    <p class="error">{{ $message }}</p>
  @enderror

  <label>メールアドレス</label>
  <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
  @error('email')
    <p class="error">{{ $message }}</p>
  @enderror

  <label>パスワード</label>
  <input type="password" name="password" placeholder="パスワードを入力">
  @error('password')
    <p class="error">{{ $message }}</p>
  @enderror

  <button class="btn">次に進む</button>
</form>

<a href="/login" class="login-link">ログインはこちら</a>
@endsection
