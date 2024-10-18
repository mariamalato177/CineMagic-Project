@extends('layouts.main')

@section('main')
<div class="container">
    <h1>Occupancy Rate</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Movie</th>
                <th>Occupancy Rate (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($occupancy as $item)
            <tr class="{{ getOccupancyClass($item['occupancy_rate']) }}">
                <td>{{ $item['movie'] }}</td>
                <td>{{ number_format($item['occupancy_rate'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


