<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{ mix('css/reset.css') }}">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}"></script>
  <link rel="stylesheet" href="{{ mix('css/style.css') }}">
</head>
<body>
  <header>
    <h1>Atte</h1>
    <div class="hamburger-demo-menubox">
      <input id="hamburger-demo1" type="checkbox" class="input-hidden">
      <label for="hamburger-demo1" class="hamburger-demo-switch hamburger-demo-switch1">
        <span class="hamburger-switch-line1"></span>
      </label>
      <div class="hamburger-demo-menuwrap">
        <ul class="hamburger-demo-menulist">
          <li><a href="/">ホーム</a></li>
          <li><a href="/attendance">日付一覧</a></li>
          <li><a href="/userpage">ユーザーページ</a></li>
          <li><a href="/logout">ログアウト</a></li>
        </ul>
      </div>
      <div class="hamburger-demo-cover"></div>
    </div>
    <nav class="navigation pc">
      <a href="/">ホーム</a>
      <a href="/attendance">日付一覧</a>
      <a href="/userpage">ユーザーページ</a>
      <a href="/logout">ログアウト</a>
    </nav>
  </header>
  <div class="content">
    @yield('content')
  </div>
  <footer>
    Atte,inc.
  </footer>
</body>
</html>