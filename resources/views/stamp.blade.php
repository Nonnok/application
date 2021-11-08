<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>打刻ページ</title>
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
    .elsep {
      text-align: center;
      font-size: 36px;
    }

    .elsea {
      display: block;
      text-align: center;
      align-items: center;
      color: white;
      text-decoration: none;
      border: none;
      border-radius: 3px;
      background: royalblue;
      width: 280px;
      padding: 1em;
      margin: 20px auto;
    }

    .elseabout {
      display: block;
      margin: 20% auto;
    }

    .elsebody {
      min-height: calc(100vh - 67.5px);
    }


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
    
    .stamp {
      background:white;
      margin: 10px;
      border-radius: 3px;
      font-size: 24px;
      width: 560px;
      height: 9em;
      border-radius: 3px;
      border: none;
    }
    
    .buttons {
      display: flex;
      margin: 10px auto;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      max-width: 80%;
    }

    @media screen and (min-width: 1222px) {
      main {
        min-height: calc(100vh - 67.5px);
      }
    }

    .message {
      text-align: center;
      font-size: 20px;
    }
  </style>
<body>
  <main>
    
    @if (Auth::check())
    <header>
      <h1>Atte</h1>
  
      <nav>
        <a href="/">ホーム</a>
        <a href="/attendance">日付一覧</a>
        <a href="/logout">ログアウト</a>
      </nav>
    </header>
  <h2>{{ \Auth::user()->name }}さんお疲れ様です！</h2>
  <p class="message">{{ session('message') }}</p>
    <div class="buttons">
        <div>
          <form class="timestamp" action="/timein" method="post">
            {{ csrf_field() }}
            <button class="stamp">勤怠開始</button>
          </form>
        </div>
      
      <div>
        <form class="timestamp" action="/timeout" method="post">
          {{ csrf_field() }}
          <button class="stamp">勤怠終了</button>
        </form>
      </div>

      <div>
        <form class="timestamp" action="/breakin" method="post">
          {{ csrf_field() }}
          <button class="stamp">休憩開始</button>
        </form>
      </div>

      <div>
        <form class="timestamp" action="/breakout" method="post">
          {{ csrf_field() }}
          <button class="stamp">休憩終了</button>
        </form>
      </div>
    </div>
    @else
    <div class="elsebody">
      <header>
      <h1>Atte</h1>

      <nav>
        <a href="/">ホーム</a>
        <a href="">日付一覧</a>
        <a href="/logout">ログアウト</a>
      </nav>
    </header>
    <div class="elseabout">
      <p class="elsep">ゲストさん</p>
      <a href="/register" class="elsea">会員登録</a>
    </div>
    </div>
    @endif
  </main>
    

  <footer>
    Atte,inc.
  </footer>
</body>
</html>