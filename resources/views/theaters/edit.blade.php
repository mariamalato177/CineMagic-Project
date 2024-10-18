@extends('layouts.main')

@section('header-title', $theater->name)

@section('main')
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
        <div class="max-full">
            <section>
                <div class="flex flex-wrap justify-end items-center gap-4 mb-4">
                    <x-button
                        href="{{ route('theaters.create', ['theater' => $theater]) }}"
                        text="New"
                        type="success"/>
                    <x-button
                        href="{{ route('theaters.show', ['theater' => $theater]) }}"
                        text="View"
                        type="info"/>
                    <form method="POST" action="{{ route('theaters.destroy', ['theater' => $theater]) }}">
                        @csrf
                        @method('DELETE')
                        <x-button
                            element="submit"
                            text="Delete"
                            type="danger"/>
                    </form>
                </div>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Edit theater "{{ $theater->name }}"
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300  mb-6">
                        Click on "Save" button to store the information.
                    </p>
                </header>

                <form method="POST" action="{{ route('theaters.update', ['theater' => $theater]) }}"enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mt-6 space-y-4">
                            @include('theaters.shared.fields', ['mode' => 'create'])

                            <div>
                                <label for="rows">Rows</label>
                                <input type="text" name="rows" id="rows" required>
                            </div>
                            <div>
                                <label for="seats_per_row">Seats per Row</label>
                                <input type="number" name="seats_per_row" id="seats_per_row" required>
                            </div>
                            <div class="mb-4">
                                <label for="inputPhoto" class="text-black block mb-1">Theater Image</label>
                                <input type="file" name="photo_filename" id="inputPhoto"
                                    class=" bg-white text-black py-2 px-4 rounded w-full">
                            </div>
                        </div>

                        <div class="flex mt-6">
                            <x-button element="submit" type="dark" text="Save new theater" class="uppercase"/>
                        </div>

                    </form>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection

