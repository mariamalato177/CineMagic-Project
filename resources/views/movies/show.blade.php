@extends('layouts.main')

@section('header-title', $movie->title)

@section('main')
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
        <div class="max-full">
            <section>

                <div class="mt-6 space-y-4">
                    @include('movies.shared.fields', ['mode' => 'show'])
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
