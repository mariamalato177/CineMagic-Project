@extends('layouts.main')

@section('header-title', 'Add a Genre')

@section('main')
<header class="bg-white  shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            @yield('header-title')
        </h2>
    </div>
</header>
    <div class="container mx-auto px-8 py-4">


        <form method="POST" action="{{ route('genres.store') }}">
            @csrf
            <div class="mt-4 mb-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 mt-3">
                        <div class="flex items-center mb-4">
                            <label for="inputCode" class="text-black w-24">Genre Code</label>
                            <input type="text" name="code" id="inputCode" value="" class="border border-gray-700 bg-white text-black py-2 px-4 rounded flex-1 ml-2">
                        </div>
                        <div class="flex items-center mb-4">
                            <label for="inputName" class="text-black w-24">Name</label>
                            <input type="text" name="name" id="inputName" value="" class="border border-gray-700 bg-white text-black py-2 px-4 rounded flex-1 ml-2">
                        </div>
                    </div>
                </div>
                <div class="flex mt-6">
                    <x-button element="submit" type="dark" text="Save new genre" class="uppercase"/>
                </div>
            </div>
        </form>

    </div>
@endsection
