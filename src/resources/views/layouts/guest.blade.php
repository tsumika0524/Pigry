<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
  <div class="bg">
    <div class="card">
      @yield('content')
    </div>
  </div>
</body>
</html>
