<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
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

    input, select {
      vertical-align: middle;
    }

    header {
      background: white;
      height: 86px;
      width: 100%;
    }
    h1 {
      font-weight: normal;
      font-size: 36px;
      padding: 24px 24px 24px 36px;
    }
    table {
      width: 100%;
      padding-bottom: 30px;
    }

    form {
      background: whitesmoke;
      width: 100%;
    }

    th {
      font-weight: normal;
      padding: 36px;
      font-size: 24px;
      padding-top: 100px;
    }
    
    tr, td {
      text-align: center;
      padding-bottom: 20px;
      height: 24px;
    }
    
    input {
      width: 330px;
      padding: 12px;
      background: whitesmoke;
      border-style: normal;
      border-color: dimgray;
      border-color: black;
      height: 24px;
      border-radius: 3px;
    }

    button {
      width: 360px;
      padding: 12px;
      background: royalblue;
      border: none;
      color: white;
      border-radius: 3px;
    }

    a {
      text-decoration: none;
    }

    p {
      font-size: 16px;
      color: gray;
      padding: 12px;
    }
    
    footer {
      padding-top: 22.5px;
      align-items: center;
      width: 100%;
      text-align: center;
      height: 45px;
      background: white;
    }

    .error_tr {
      padding: 0;
      margin: 0;
      height: 2em;
    }

    a {
      color: blue;
      text-decoration: none;
    }

    main {
      min-height: calc(100vh - 67.5px);
      background: whitesmoke;
    }
  </style>

<body>
  <main>
  <header>
    <h1>Atte</h1>
  </header>
  @isset($errors)
  @endisset
  <form name="loginform" action="/login" method="post">
  {{ csrf_field() }}
  <table>
    <th>ログイン</th>
  
    @if(count($errors)>0)
    <tr>
      <td style="color: red">{{ $errors->first('message') }}</td>
    </tr>
    @endif
  
      <tr>
        <td><input type="text" name="email" size="30" value="{{ old('email') }}" placeholder="メールアドレス"></td>
      </tr>
      <tr>
        <td><input type="password" name="password" size="30" placeholder="パスワード"></td>
      </tr>
  
      <tr>
        <td>
          <button type="submit" name="action" value="send">ログイン</button>
        </td>
      </tr>
      <tr>
        <td>
          <p>アカウントをお持ちで無い方はこちらから</p>
          <a href="/register">会員登録</a>
        </td>
      </tr>
    </table>
  </form>
  </main>

  <footer>
    Atte,inc.
  </footer>
</body>
</html>