@extends('layouts.nonlogin')

@section('title', '登録完了画面')

@section('content')
  <main>
    <p>{{ $user -> name }}さんを登録しました。</p>
    <a href="/login">ログイン</a>
  </main>
@endsection