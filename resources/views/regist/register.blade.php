<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員登録</title>
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
    main {
      min-height: calc(100vh - 67.5px);
      background: whitesmoke;
    }

    input, select {
        vertical-align:middle;
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
      border-color: dimgray, dimgray;
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
      color: blue;
    }

    p {
      font-size: 16px;
      color: gray;
      padding: 12px;
    }
    
    footer {
      width: 100%;
      padding-top: 22.5px;
      text-align: center;
      height: 45px;
    }

    .error_tr {
      padding: 0;
      margin: 0;
      height: 2em;
    }
    .error_td {
      color: red;
      padding: 0;
      margin: 0;
    }
  </style>


<body>
  <main>
    <header>
      <h1>Atte</h1>
    </header>
    <form name="registform" action="/register" method="POST" id="registform">
      {{ csrf_field() }}
      <table>
        <th>会員登録</th>
  
        <tr>
          <td><input type="text" name="name" size="30" placeholder="名前"></td>
        </tr>
        @error('name')  
        <tr class="error_tr">
          <td class="error_td">{{$message}}</td>        
        </tr>
        @enderror
  
        <tr>
          <td><input type="text" name="email" size="30" placeholder="メールアドレス"></td>
        </tr>
        @error('email')  
        <tr class="error_tr">
          <td class="error_td">{{$message}}</td>        
        </tr>
        @enderror
  
        <tr>
          <td><input type="password" name="password" size="30" placeholder="パスワード"></td>
        </tr>
        @error('password')  
        <tr class="error_tr">
          <td class="error_td">{{$message}}</td>        
        </tr>
        @enderror
  
        <tr>
          <td><input type="password" name="password_confirmation" size="30" placeholder="確認用パスワード"></td>
        </tr>
        @error('password_confirmation')  
        <tr class="error_tr">
          <td class="error_td">{{$message}}</td>        
        </tr>
        @enderror
  
        <tr>
          <td><button type="submit" name="action" value="send">会員登録</button></td>
        </tr>
  
        <tr>
          <td>
            <p>アカウントをお持ちの方はこちらから</p>
            <a href="/login">ログイン</a>
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