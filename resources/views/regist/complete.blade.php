<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録完了</title>
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

    header {
      background: white;
      height: 80px;
      width: 100%;
    }
    h1 {
      font-weight: normal;
      font-size: 36px;
      padding: 24px 24px 24px 36px;
    }

    a {
      display: block;
      margin: 0 auto;
      text-decoration: none;
      color: white;
      background: royalblue;
      width: 280px;
      padding: 1em;
      text-align: center;
      border-radius: 3px;
    }

    p {
      padding: 24px;
      color:black;
      text-align: center;
      margin-top: 30%;
    }
    
    footer {
      width: 100%;
      padding-top: 22.5px;
      text-align: center;
      height: 45px;
    }
  </style>
<body>
  <main>
    <header>
      <h1>Atte</h1>
    </header>
    <p>{{ $user -> name }}さんを登録しました。</p>
    <a href="/">ログイン</a>
  </main>

  <footer>
    Atte,inc.
  </footer>
</body>
</html>