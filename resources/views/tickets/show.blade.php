@extends('layouts.main')

@section('header-title','Tickets')

@section('main')
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
        <div class="max-full">
            <section>
                <div class="mt-6 space-y-4">
                    <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                        <x-tickets.table :tickets="$tickets"
                            :showRemoveFromCart="true"
                            />
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
