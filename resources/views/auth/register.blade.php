@extends('layouts.nonlogin')

@section('title', '会員登録')

@section('content')
<main>
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
@endsection