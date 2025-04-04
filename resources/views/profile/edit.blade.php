@extends('layouts.main')

@section('header-title', 'Profile')

@section('main')
    <div class="min-h-screen flex flex-col justify-start items-center pt-6 sm:pt-0 bg-gray-100 ">
        <div class="w-full sm mt-6 px-6 py-4 bg-white  shadow-md overflow-hidden sm:rounded-lg">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                    {{ __('Profile') }}
                </h2>
            </x-slot>

            <div class="py-12">
                @if ($user->type != 'E')
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8">
                            <div class="max-w-lg">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                @endif
                <div class="p-4 sm:p-8 bg-white  ">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                @if ($user->type != 'E')
                <div class="p-4 sm:p-8 bg-white  ">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
