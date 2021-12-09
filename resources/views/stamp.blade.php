@extends('layouts.stampdefault')

@section('title', '打刻ページ')

@section('nav')
@if (Auth::check())
<!-- ハンバーガーメニュー -->
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
				<li><a href="/userlist">ユーザー一覧</a></li>
				<li><a href="/logout">ログアウト</a></li>
			</ul>
		</div>
		<div class="hamburger-demo-cover"></div>
	</div>
  <nav class="navigation pc">
    <a href="/">ホーム</a>
    <a href="/attendance">日付一覧</a>
    <a href="/userpage">ユーザーページ</a>
    <a href="/userlist">ユーザー一覧</a>
    <a href="/logout">ログアウト</a>
  </nav>

@else
@endif
@endsection

@section('content')
<main>
    @if (Auth::check())
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
          <div class="elseabout">
            <p class="elsep">ゲストさん</p>
            <a href="/register" class="elsea">会員登録</a>
          </div>
        </div>
    @endif
  </main>
@endsection