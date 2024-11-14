@extends('layouts.main')

@section('header-title', 'List of Theaters')

@section('main')
    <div class="flex justify-center">
        <div
            class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900  w-full max-w-6xl">
                <div class="flex items-center justify-between mb-4">
                    @can('create', App\Models\Theater::class)
                        <div class="flex items-center gap-4 mb-4">
                            <x-button href="{{ route('theaters.create') }}" text="Create a new theater" />
                        </div>
                    @endcan
                </div>
            <div class="grid grid-cols-1 gap-6">
                @can('update', App\Models\Theater::class)
                        <x-theaters.table :theaters="$theaters" :showView="true" :showEdit="true" :showDelete="true" />
                    @else
                        <x-theaters.table :theaters="$theaters" :showView="true" :showEdit="false" :showDelete="false" />
                @endcan
            </div>
            <div class="mt-6">
                {{ $theaters->links() }}
            </div>
        </div>
    </div>
@endsection
