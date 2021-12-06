<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ mix('css/reset.css') }}">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}"></script>
  <link rel="stylesheet" href="{{ mix('css/style.css') }}">
</head>
<body>
  <header>
    <h1>Atte</h1>
    @yield('nav')
  </header>
  <div class="content">
    @yield('content')
  </div>
  <footer>
    Atte,inc.
  </footer>
</body>
</html>