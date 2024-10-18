@extends('layouts.main')

@section('header-title', 'Shopping Cart')

@section('main')
<header class="bg-white dark:bg-gray-900 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('header-title')
        </h2>
    </div>
</header>

<div class="flex justify-center">
    <div class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50">
        @empty($cart)
            <h3 class="text-xl w-96 text-center">Cart is Empty</h3>
        @else
            <div class="grid grid-cols-1 gap-6 w-max-full">
                @foreach ($cart as $item)
                    <div class="font-base text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                        <div>
                            <h5>Ticket for the movie:</h5>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50">{{ $item['movie'] }}</h3>
                            <p class="text-lg text-gray-700 dark:text-gray-300">
                                Theater: <strong>{{ $item['theater'] }}</strong>
                            </p>
                            <p class="text-lg text-gray-700 dark:text-gray-300">
                                Screening: <strong>{{ $item['screeningId'] }} at {{ $item['hora'] }}</strong>
                            </p>
                            <p class="text-lg text-gray-700 dark:text-gray-300">
                                Seat: <strong>{{ $item['seatId'] }}</strong>
                            </p>
                            <p class="text-lg text-gray-700 dark:text-gray-300">
                                Price: <strong>{{ $item['price'] }} €</strong>
                            </p>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <form action="{{ route('cart.remove', ['seatId' => $item['seatId'], 'screeningId' => $item['screeningId']]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button element="submit" type="danger" text="Remove" class="mt-2" />
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-between space-x-12 items-end">
                <div>
                    <h3 class="mb-4 text-xl">Shopping Cart Confirmation</h3>
                    <form action="{{ route('cart.form') }}" method="get">
                        @csrf
                        <x-button element="submit" type="dark" text="Confirm" class="mt-4"/>
                    </form>
                </div>
                <div>
                    <form action="{{ route('cart.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-button element="submit" type="danger" text="Clear Cart" class="mt-4"/>
                    </form>
                </div>
            </div>
        @endempty
    </div>
</div>
@endsection
