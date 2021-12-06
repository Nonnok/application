@extends('layouts.default')

@section('title', 'ユーザーページ')

@section('content')
  <main>
    <p class="message">{{ session('message') }}</p>
    
    <div class="date-line mx-auto">
    </div>

    <div class="month date-line">
      @foreach($allDate as $whereMonth)
      <h1 class="date">{{ $whereMonth->date->format('m') }}月</h1>
      @endforeach
      {{ $allDate->links() }}
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
  </main>
@endsection