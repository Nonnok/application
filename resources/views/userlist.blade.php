@extends('layouts.stampdefault')

@section('title', 'ユーザー一覧')

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
  @if(Auth::check())
  <h2>ユーザー一覧</h2>
    <table>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td class="table-item user-name">{{ $user->name }}</td>
          @endforeach
      </tbody>
    </table>
    <div class="workPage paginate">
      {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
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