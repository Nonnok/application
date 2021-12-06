@extends('layouts.nonlogin')

@section('title', 'ログイン')

@section('content')
<main>
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
@endsection