@extends('layouts.main')

@section('header-title', $movie->title)

@section('main')
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg">
        <div class="max-full">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 ">
                        Edit movie "{{ $movie->title }}"
                    </h2>
                    <p class="mt-1 text-sm text-gray-600   mb-6">
                        Click on "Save" button to store the information.
                    </p>
                </header>

                <form method="POST" action="{{ route('movies.update', ['movie' => $movie]) }}"enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-6 space-y-4">

                        @include('movies.shared.fields', ['mode' => 'edit', 'genres' => $genres])
                    </div>
                    <div class="flex mt-6">
                        <x-button element="submit" type="dark" text="Save" class="uppercase"/>
                        <x-button element="a" type="light" text="Cancel" class="uppercase ms-4"
                                    href="{{ route('movies.index')}}"/>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection
