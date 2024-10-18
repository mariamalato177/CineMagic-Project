@extends('layouts.main')

@section('main')
<div class="container mx-auto px-8 py-4">
<div class="flex justify-between items-center mb-8">
    <h1 class="text-4xl font-bold text-white mb-2 mt-6">Create a User</h1>
</div>
    <div class="container mx-auto px-8 py-4">
        <form method="POST" action="{{ route('users.storeNewUser') }}" enctype="multipart/form-data">
            @csrf
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="text-white px-6 py-4">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" id="name" class="border border-gray-700 bg-gray-900 text-white py-2 px-4 rounded w-full mt-1">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" id="email" class="border border-gray-700 bg-gray-900 text-white py-2 px-4 rounded w-full mt-1">
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium">Type</label>
                        <select name="type" id="type" class="border border-gray-700 bg-gray-900 text-white py-2 px-4 rounded w-full mt-1">
                            <option value="E">Employee</option>
                            <option value="A">Admin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" name="password" id="password" class="border border-gray-700 bg-gray-900 text-white py-2 px-4 rounded w-full mt-1">
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium">Photo</label>
                        <input type="file" name="photo_filename" id="photo" class="border border-gray-700 bg-gray-900 text-white py-2 px-4 rounded w-full mt-1">
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-300 transition duration-300 ease-in-out">
                    Create Staff
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
