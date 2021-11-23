<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>日付一覧</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<style>
    /*
    html5doctor.com Reset Stylesheet
    v1.6.1
    Last Updated: 2010-09-17
    Author: Richard Clark - http://richclarkdesign.com
    Twitter: @rich_clark
    */

    html, body, div, span, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    abbr, address, cite, code,
    del, dfn, em, img, ins, kbd, q, samp,
    small, strong, sub, sup, var,
    b, i,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section, summary,
    time, mark, audio, video {
        margin:0;
        padding:0;
        border:0;
        outline:0;
        font-size:100%;
        vertical-align:baseline;
        background:transparent;
    }

    body {
        line-height:1;
    }

    article,aside,details,figcaption,figure,
    footer,header,hgroup,menu,nav,section {
        display:block;
    }

    nav ul {
        list-style:none;
    }

    blockquote, q {
        quotes:none;
    }

    blockquote:before, blockquote:after,
    q:before, q:after {
        content:'';
        content:none;
    }

    a {
        margin:0;
        padding:0;
        font-size:100%;
        vertical-align:baseline;
        background:transparent;
    }

    /* change colours to suit your needs */
    ins {
        background-color:#ff9;
        color:#000;
        text-decoration:none;
    }

    /* change colours to suit your needs */
    mark {
        background-color:#ff9;
        color:#000;
        font-style:italic;
        font-weight:bold;
    }

    del {
        text-decoration: line-through;
    }

    abbr[title], dfn[title] {
        border-bottom:1px dotted;
        cursor:help;
    }

    table {
        border-collapse:collapse;
        border-spacing:0;
    }

    /* change border colour to suit your needs */
    body {
      background: whitesmoke;
    }

    input, select {
        vertical-align:middle;
    }

    header {
      background: white;
      height: 80px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    nav a {
      color: black;
      padding: 28px;
    }

    h1 {
      font-weight: normal;
      font-size: 36px;
      padding: 24px 24px 24px 36px;
    }

    h2 {
      text-align: center;
      font-weight: normal;
      padding: 36px;
      font-size: 24px;
    }

    a {
      text-decoration: none;
    }
    
    footer {
      width: 100%;
      text-align: center;
      height: 45px;
      background: white;
      padding-top: 22.5px;
    }

    main {
      min-height: calc(100vh - 67.5px);
    }
    
    .message {
      text-align: center;
      font-size: 20px;
    }

    /* @media screen and (min-width: 1222px) {
      main {
        min-height: calc(100vh - 67.5px);
      }
    } */

    table {
      width: 85%;
      margin: 25px auto;
    }
    th {
      padding: 25px;
    }

    td {
      padding: 25px;
    }
    tr {
      border-top: gray 1px solid;
    }

    .date-line {
      text-align: center;
      margin-top: 24px;
    }
    .date {
      font-size: 25px;
    }

    .table-item {
      text-align: center;
    }

    nav {
      display: flex;
      justify-content: center;
    }
  </style>

<body>

<!-- create_userpage -->

  <div id="app"></div>
  <main>
    <header>
    <h1>Atte</h1>
      <nav>
        <a href="/">ホーム</a>
        <a href="/attendance">日付一覧</a>
        <a href="/logout">ログアウト</a>
      </nav>
    </header>

    <p class="message">{{ session('message') }}</p>
    
    <div class="date-line mx-auto">
      {{ $allDate->links() }}
      @foreach($allDate as $date)
          <h1 class="date">{{ $date->date->format('Y-m-d') }}</h1>
      @endforeach
    </div>

    <table>
      <thead>
        <tr>
          <th class="table-title">名前</th>
          <th class="table-title">勤怠開始</th>
          <th class="table-title">勤怠終了</th>
          <th class="table-title">休憩時間</th>
          <th class="table-title">勤務時間</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($works as $work)
        <tr>
          <td class="table-item">{{ $work->name }}</td>
          <td class="table-item">{{ $work->punchIn->format('H:i:s') }}</td>

          @if ($work->punchOut == null)
            <td class="table-item">記録なし</td>
            @else
            <td class="table-item">{{ $work->punchOut->format('H:i:s') }}</td>
          @endif

          @if (!empty($work->work_id))
            <td class="table-item">{{ gmdate("H:i:s",$work->sum_rest_time) }}</td>
          @else
            <td class="table-item">記録なし</td>
          @endif
            <td class="table-item">{{ gmdate("H:i:s",(strtotime($work->punchOut)-strtotime($work->punchIn))) }}</td>
        </tr>
          @endforeach
      </tbody>
    </table>
    <div class="workPage mx-auto">
      {{ $works->appends(request()->input())->links() }}
    </div>
  </main>
  <footer>
    Atte,inc
  </footer>

  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>