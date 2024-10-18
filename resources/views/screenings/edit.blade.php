@extends('layouts.main')

@section('header-title', $screening->movieRef->title)

@section('main')
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
        <div class="max-full">
            <section>
                <header>
                    <div class="flex flex-wrap justify-end items-center gap-4 mb-4">
                        <x-button
                            href="{{ route('screenings.create', ['screening' => $screening]) }}"
                            text="New"
                            type="success"/>
                        <x-button
                            href="{{ route('screenings.show', ['screening' => $screening]) }}"
                            text="View"
                            type="info"/>
                        <form method="POST" action="{{ route('screenings.destroy', ['screening' => $screening]) }}">
                            @csrf
                            @method('DELETE')
                            <x-button
                                element="submit"
                                text="Delete"
                                type="danger"/>
                        </form>
                    </div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Edit screening "{{ $screening->movieRef->title }}"
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300  mb-6">
                        Click on "Save" button to store the information.
                    </p>
                </header>

                <form method="POST" action="{{ route('screenings.update', ['screening' => $screening]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mt-6 space-y-4">
                        @include('screenings.shared.fields', ['mode' => 'edit'])
                    </div>
                    <div class="flex mt-6">
                        <x-button element="submit" type="dark" text="Save" class="uppercase"/>
                        <x-button element="a" type="light" text="Cancel" class="uppercase ms-4"
                                    href="{{ route('screenings.index')}}"/>
                    </div>
                </form>

            </section>
        </div>
    </div>
</div>
@endsection
