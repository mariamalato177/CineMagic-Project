@extends('layouts.main')

@section('header-title','Customers')

@section('main')
<header class="bg-white dark:bg-gray-900 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('header-title')
        </h2>
    </div>
</header>
    <div class="container mx-auto px-4 pt-16">


        <x-users.filter-card :filterAction="route('users.list')" :resetUrl="route('users.list')" :searchName="old('string', $filterByName)" class="mb-6" />

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-8 mt-8">
            @foreach ($users as $user)
                <div class="bg-white rounded-lg overflow-hidden shadow-lg flex flex-col">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ $user->photoFullUrl ? $user->photoFullUrl : asset('storage/app/public/photos/anonymous.jpg')  }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                    </div>
                    <div class="flex flex-col justify-between flex-grow p-4">
                        <div>
                            <p class="text-white text-lg font-semibold">{{ $user->name }}</p>
                            <p class="text-gray-400">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-orange-200 font-bold mt-2.5">Customer</p>
                            <div class="flex justify-between font-bold">
                                @if (!$user->isBlocked($user->id))
                                    <form method="POST" action="{{ route('users.block', ['user' => $user->id]) }}"
                                        onsubmit="return confirm('Are you sure you want to block this user?')"
                                        class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <x-button element="submit" type="danger" text="Block" />
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('users.unblock', ['user' => $user->id]) }}"
                                        onsubmit="return confirm('Are you sure you want to unblock this user?')"
                                        class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <x-button element="submit" type="success" text="Unblock" />
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this user?')"
                                    class="inline-block">
                                    @csrf
                                    @method('delete')
                                    <x-button element="submit" type="danger" text="Delete" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
