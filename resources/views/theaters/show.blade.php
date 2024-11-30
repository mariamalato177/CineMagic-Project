@extends('layouts.main')

@section('header-title', 'Theater' . ' ' . $theater->name)

@section('main')
<header class="bg-white  shadow flex justify-center">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center">
        <div class="flex flex-col lg:flex-row items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center lg:text-left lg:mr-4">
                @yield('header-title')
            </h2>
            @if ($theater->imageExists)
            <div class="flex justify-center lg:justify-start w-full lg:w-auto lg:flex-grow px-6 pt-8 lg:pt-0">
                <img src="{{ $theater->imageUrl }}" alt="{{ $theater->name }}"
                    class="w-full lg:w-auto lg:max-w-2xl h-auto rounded-lg shadow-lg"
                    style="max-height: 275px;">
            </div>
            @endif
        </div>
    </div>
</header>

    <br>
    <div class="flex justify-center mb-4">
        <div class="w-full max-w-3xl h-12 bg-gray-300  rounded-md flex items-center justify-center">
            <span class="text-lg font-bold text-gray-800 ">Screen</span>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="flex justify-center">
        <div class="grid gap-6">
            @foreach ($seats->groupBy('row') as $row => $seatsByRow)
                <div class="flex justify-center gap-2">
                    @foreach ($seatsByRow as $seat)
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px" viewBox="0 0 600 600"
                                version="1.1">
                                <g id="surface1">
                                    <path style="stroke:black;fill:black;fill-opacity:1;"
                                        d="M 539.128906 243.484375 L 539.128906 139.050781 C 539.128906 62.230469 476.839844 0 400.019531 0 L 199.980469 0 C 123.160156 0 60.871094 62.230469 60.871094 139.050781 L 60.871094 243.484375 C 28.984375 244.367188 2.898438 270.652344 2.898438 302.863281 L 2.898438 578.527344 C 2.898438 590.535156 12.632812 600 24.636719 600 L 154.40625 600 C 166.414062 600 176.8125 590.535156 176.8125 578.527344 L 176.8125 572.460938 L 423.191406 572.460938 L 423.191406 578.527344 C 423.191406 590.535156 433.589844 600 445.597656 600 L 575.363281 600 C 587.371094 600 597.101562 590.535156 597.101562 578.527344 L 597.101562 302.863281 C 597.101562 270.65625 571.015625 244.367188 539.128906 243.484375 Z M 133.332031 556.523438 L 46.375 556.523438 L 46.375 302.863281 C 46.375 294.074219 53.527344 286.957031 62.320312 286.957031 L 116.726562 286.957031 C 125.515625 286.957031 133.332031 294.074219 133.332031 302.863281 Z M 423.1875 528.984375 L 176.8125 528.984375 L 176.8125 420.289062 L 423.1875 420.289062 Z M 423.1875 302.863281 L 423.1875 344.925781 L 176.8125 344.925781 L 176.8125 302.863281 C 176.8125 270.097656 149.488281 243.476562 116.722656 243.476562 L 104.347656 243.476562 L 104.347656 139.050781 C 104.347656 86.203125 147.132812 43.480469 199.980469 43.480469 L 400.015625 43.480469 C 452.867188 43.480469 495.652344 86.207031 495.652344 139.050781 L 495.652344 243.476562 L 483.273438 243.476562 C 450.511719 243.476562 423.1875 270.097656 423.1875 302.863281 Z M 553.625 556.523438 L 466.667969 556.523438 L 466.667969 302.863281 C 466.667969 294.074219 474.484375 286.957031 483.273438 286.957031 L 537.679688 286.957031 C 546.472656 286.957031 553.625 294.074219 553.625 302.863281 Z M 553.625 556.523438 " />
                                </g>
                            </svg>
                            <h1 class="text-center" style="color:black;">{{ $seat->seatName }}</h1>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
