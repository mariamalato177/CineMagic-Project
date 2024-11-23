@extends('layouts.main')

@section('header-title', 'Show info for '. $user->name)

@section('main')
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg">
        <div class="max-full">
            <section>
                <div class="flex flex-wrap justify-end items-center gap-4 mb-4">
                    <x-button
                        href="{{ route('users.create', ['user' => $user]) }}"
                        text="New"
                        type="success"/>
                    <x-button
                        href="{{ route('users.show', ['user' => $user]) }}"
                        text="View"
                        type="info"/>
                    <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                        @csrf
                        @method('DELETE')
                        <x-button
                            element="submit"
                            text="Delete"
                            type="danger"/>
                    </form>
                </div>
                <div class="mt-6 space-y-4">
                    @include('users.shared.fields_foto', [
                        'user' => $user,
                        'allowUpload' => false,
                        'allowDelete' => false,
                    ])
                </div>
                <div class="mt-6 space-y-4">
                    @include('users.shared.fields', ['user' => $user,'mode' => 'show'])
                </div>

            </section>
        </div>
    </div>
</div>
@endsection
