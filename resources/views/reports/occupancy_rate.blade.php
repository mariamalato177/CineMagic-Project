@extends('layouts.main')

@section('header-title', 'Occupancy Rate')

@section('main')
<header class="bg-white  shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            @yield('header-title')
        </h2>
    </div>
</header>
<div class="container mx-auto mt-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($occupancy->sortByDesc('occupancy_rate') as $item)
            <div class="bg-white  rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 flex">
                <div class="w-1/3 h-full overflow-hidden flex justify-center items-center">
                    @if($item['img'])
                        <img src="{{ $item['img'] }}" alt="{{ $item['movie'] }}"
                             class="w-full h-auto object-contain rounded-lg">
                    @else
                        <span>No Image Available</span>
                    @endif
                </div>

                <div class="w-2/3 pl-4 flex flex-col justify-between">
                    <div class="flex flex-col justify-between h-full">
                        <div class="mb-2">
                            <h3 class="text-lg font-bold text-gray-900 ">{{ $item['movie'] }}</h3>
                        </div>
                        <div class="relative">
                            <div class="w-full h-4 bg-gray-300 rounded-full">
                                <div class="h-4 bg-green-500 rounded-full text-white text-sm text-center leading-none"
                                     style="width: {{ $item['occupancy_rate'] }}%">
                                    {{ number_format($item['occupancy_rate'], 2) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
