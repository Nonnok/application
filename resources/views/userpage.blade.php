@extends('layouts.stampdefault')

@section('title', 'ユーザーページ')

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
    {{ session('message') }}
    <div class="month date-line">
      @foreach($allDate as $whereMonth)
      <h1 class="date">{{ $whereMonth->date }}月</h1>
      @endforeach
      {{ $allDate->links() }}
      <p class="message">{{ session('message') }}</p>
    </div>
    <table>
      <thead>
        <tr>
          <th class="table-title">日</th>
          <th class="table-title">勤怠開始</th>
          <th class="table-title">勤怠終了</th>
          <th class="table-title">休憩時間</th>
          <th class="table-title">勤務時間</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($myworks as $work)
        <tr>
          <td class="table-item">{{ $work->date->format('d') }}</td>
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
    <div class="workPage paginate">
      {{ $myworks->appends(request()->input())->links() }}
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