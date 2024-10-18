@extends('layouts.main')

@section('header-title')

@section('main')
    <div class="flex flex-col space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-white shadow sm:rounded-lg">
            <div class="max-full">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Edit "{{ $user->name }}"
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300  mb-6">
                            Click on "Save" button to store the information.
                        </p>
                    </header>
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <div class="px-6 py-4">
                                <div class="mb-4">
                                    <label for="name" class="text-black block mb-2">Name:</label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="border border-gray-700 bg-white text-black py-2 px-4 rounded w-full focus:outline-none focus:border-gray-500">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="text-black block mb-2">Email:</label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="border border-gray-700 bg-white text-black py-2 px-4 rounded w-full focus:outline-none focus:border-gray-500">
                                </div>
                                <div class="mb-4">
                                    <label for="type" class="text-black block mb-2">Type:</label>
                                    <select id="type" name="type" class="border border-gray-700 bg-white text-black py-2 px-4 rounded w-full focus:outline-none focus:border-gray-500">
                                        <option value="E" {{ $user->type == 'E' ? 'selected' : '' }}>Employee</option>
                                        <option value="A" {{ $user->type == 'A' ? 'selected' : '' }}>Administrator</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="blocked" class="text-black block mb-2">Blocked:</label>
                                    <select id="blocked" name="blocked" class="border border-gray-700 bg-white text-black py-2 px-4 rounded w-full focus:outline-none focus:border-gray-500">
                                        <option value="0" {{ $user->blocked == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $user->blocked == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="photo" class="text-black block mb-2">Photo:</label>
                                    <input type="file" id="photo" name="photo" class="  bg-white text-black py-2 px-4 rounded w-full focus:outline-none focus:border-gray-500">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-coral hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 ease-in-out">
                                Update
                            </button>
                        </div>
                    </form>

                </section>
            </div>
        </div>
    </div>
@endsection

