<header class="header">
  <div class="header-inner">
    <h1 class="logo">PiGLy</h1>

    <div class="header-actions">
      <a href="{{ url('/wight_logs/goal_setting') }}" class="btn-outline">⚙️ 目標体重設定</a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-outline">🚪ログアウト</button>
      </form>
    </div>
  </div>
</header>

