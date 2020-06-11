@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $tittle ?? 'Dashboard' }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="" name="location"  >地點</th>
                                <th class="" name="temp"  >期間</th>
                                <th class="" name="weather"  >天氣</th>
                                <th class="" name="weather"  >最低溫度</th>
                                <th class="" name="weather"  >最高溫度</th>
                                <th class="" name="weather"  >體感</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if($list)
                            @foreach ($list as $l)
                            <tr>
                                <td class="">{{ $l['locationName'] ?? ''}}</td>
                                <td class="">{{ $l['startTime'] . '~' .$l['endTime']}}</td>
                                <td class="">{{ $l['status'] ?? ''}}</td>
                                <td class="">{{ $l['temp_low'] ?? ''}}</td>
                                <td class="">{{ $l['temp_high'] ?? ''}}</td>
                                <td class="">{{ $l['feeling'] ?? ''}}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
