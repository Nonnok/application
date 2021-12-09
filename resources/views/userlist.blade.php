@extends('layouts.default')

@section('title', 'ユーザー一覧')

@section('content')
<main>
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
  </main>
@endsection