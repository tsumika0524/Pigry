<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PiGLy')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<script>
function openModal() {
  document.getElementById('weightModal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('weightModal').style.display = 'none';
}
</script>

<body>
    {{-- 共有ヘッダー --}}
    @include('components.header')

    <main class="container">
        @yield('content')
        @yield('css')
    </main>
</body>
</html>
