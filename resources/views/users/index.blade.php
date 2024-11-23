@extends('layouts.main')

@section('header-title','Admins & Employees')

@section('main')
<header class="bg-white  shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('header-title')
        </h2>
    </div>
</header>
    <div class="container mx-auto px-4 pt-16">
        <div class="flex items-center gap-4 mb-4">
            <x-button href="{{ route('users.create') }}" text="Create a new User" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-8 mt-8">
            @foreach ($staffs as $staff)
                <div class="bg-white rounded-lg overflow-hidden shadow-lg flex flex-col">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ $staff->photoFullUrl }}" class="w-full h-full object-cover" alt="{{ $staff->name }}">
                    </div>
                    <div class="flex flex-col justify-between flex-grow p-4">
                        <div>
                            <p class="text-black text-lg font-semibold">{{ $staff->name }}</p>
                            <p class="text-gray-400">{{ $staff->email }}</p>
                        </div>
                        <div class="mt-auto">
                            @if ($staff->type === 'E')
                                <p class="text-green-500 font-bold">Employee</p>
                            @elseif ($staff->type === 'A')
                                <p class="text-blue-500 font-bold">Administrator</p>
                            @endif

                        </div>

                        @if (!$staff->isBlocked($staff->id))
                        <form method="POST" action="{{ route('users.block', ['user' => $staff->id]) }}"
                            onsubmit="return confirm('Are you sure you want to block this user?')" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <x-button element="submit" type="danger" text="Block" />
                        </form>
                    @else
                        <form method="POST" action="{{ route('users.unblock', ['user' => $staff->id]) }}"
                            onsubmit="return confirm('Are you sure you want to unblock this user?')" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <x-button element="submit" type="success" text="Unblock" />
                        </form>
                    @endif
                    <div class="flex items-center space-x-2 mt-2">
                        <x-table.icon-show href="{{ route('users.show', ['user' => $staff]) }}" />
                        <x-table.icon-edit href="{{ route('users.edit', ['user' => $staff]) }}" />
                        <x-table.icon-delete action="{{ route('users.destroy', ['user' => $staff]) }}" />
                    </div>


                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $staffs->links() }}
        </div>
    </div>
@endsection
