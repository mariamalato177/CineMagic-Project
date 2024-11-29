@extends('layouts.main')

@section('header-title', 'Shopping Cart')

@section('main')
@php
$user = auth()->user();

@endphp
<div class="flex justify-center mt-10 space-x-8">
    <div class="w-full max-w-2xl p-8 bg-white shadow-md rounded-lg text-gray-900 ">
        <h3 class="mb-6 text-2xl font-bold">Customer Information</h3>
        <div class="flex justify-center mt-2">
            <div class="w-full max-w-2xl p-8 bg-white  shadow-md rounded-lg text-gray-900 ">
                <form action="{{ route('cart.confirm') }}" method="POST" id="checkoutForm">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $user?->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="text" class="mt-1 block w-full"
                            :value="old('email', $user?->email)" required autofocus autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="nif" :value="__('Nif')" />
                        <x-text-input id="nif" name="nif" type="text" class="mt-1 block w-full"
                            :value="old('nif', $user?->customer->nif)" />
                        <x-input-error class="mt-2" :messages="$errors->get('nif')" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="payment_type" :value="__('Payment Type')" />
                        <select id="payment_type" name="payment_type"
                            class="mt-1 block w-full @error('payment_type') border-red-500 @enderror" required
                            style="color: black;">
                            <option value="">Select Payment Type</option>
                            <option value="VISA"
                                {{ old('payment_type', auth()->user()->customer->payment_type ?? '') == 'VISA' ? 'selected' : '' }}>
                                VISA</option>
                            <option value="PAYPAL"
                                {{ old('payment_type', auth()->user()->customer->payment_type ?? '') == 'PAYPAL' ? 'selected' : '' }}>
                                PAYPAL</option>
                            <option value="MBWAY"
                                {{ old('payment_type', auth()->user()->customer->payment_type ?? '') == 'MBWAY' ? 'selected' : '' }}>
                                MBWAY</option>
                        </select>
                        @error('payment_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Additional Inputs based on Payment Type --}}
                    <div id="visaInputs" class="mb-4" style="display: none;">
                        <x-input-label for="card_number" :value="__('Card Number')" />
                        <x-text-input id="payment_reference" name="card_number" type="text" class="mt-1 block w-full"
                            :value="old('card_number')" />
                        <x-input-error class="mt-2" :messages="$errors->get('card_number')" />

                        <x-input-label for="cvc_code" :value="__('CVC')" />
                        <x-text-input id="payment_reference" name="cvc" type="text" class="mt-1 block w-full"
                            :value="old('cvc_code')" />
                        <x-input-error class="mt-2" :messages="$errors->get('cvc_code')" />
                    </div>

                    <div id="paypalInputs" class="mb-4" style="display: none;">
                        <x-input-label for="email_address" :value="__('PayPal Email')" />
                        <x-text-input id="payment_reference" name="email_address" type="text" class="mt-1 block w-full"
                            :value="old('email_address')" />
                        <x-input-error class="mt-2" :messages="$errors->get('email_address')" />
                    </div>

                    <div id="mbwayInputs" class="mb-4" style="display: none;">
                        <x-input-label for="phone_number" :value="__('Phone Number')" />
                        <x-text-input id="payment_reference" name="phone_number" type="text" class="mt-1 block w-full"
                            :value="old('phone_number')" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                    </div>

                    {{-- <div class="mb-4">
                        <x-input-label for="payment_reference" :value="__('Payment Reference')" />
                        <x-text-input id="payment_reference" name="payment_reference" type="text"
                            class="mt-1 block w-full"
                            :value="old('payment_ref', auth()->user()->customer->payment_ref ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('payment_reference')" />
                    </div> --}}
                    <button type="submit"
                        class="w-full bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 transition duration-300">Confirm
                        Order</button>
                </form>
            </div>
        </div>
    </div>

    <div class="w-full max-w-4xl p-8 bg-white  shadow-md rounded-lg text-gray-900 ">
        @empty($cart)
        <h3 class="text-2xl text-center">Cart is Empty</h3>
        @else
        <div>
            <h3 class="mb-6 text-2xl font-bold">Shopping Cart Confirmation</h3>
            @foreach ($cart as $item)
            @php
            $tmdbId = $item['custom'];
                    $movieData=[];
                    $movieData = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
                        return $this->tmdbService->getMovieByID($tmdbId);
                    });
                    $date = \Carbon\Carbon::parse($item['date'])->format('d-m-Y');
            @endphp
            <div class="mb-6 p-4 bg-gray-100  rounded-lg">
                <p><strong>Seat ID:</strong> {{ $item['seatId'] }}</p>
                <p><strong>Screening ID:</strong> {{ $item['screeningId'] }}</p>
                <p><strong>Price:</strong> {{ $item['price'] }}€</p>
                <p><strong>Movie:</strong> {{ $movieData['title'] }}</p>
                <p><strong>Date:</strong> {{ $date }}</p>
                <p><strong>Start Time:</strong> {{ $item['hora'] }}</p>
                <p><strong>Theater:</strong> {{ $item['theater'] }}</p>
            </div>
            @endforeach
        </div>
        @endempty
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentTypeSelect = document.getElementById('payment_type');
        const visaInputs = document.getElementById('visaInputs');
        const paypalInputs = document.getElementById('paypalInputs');
        const mbwayInputs = document.getElementById('mbwayInputs');

        function toggleInputs() {
            visaInputs.style.display = 'none';
            paypalInputs.style.display = 'none';
            mbwayInputs.style.display = 'none';

            const selectedPaymentType = paymentTypeSelect.value;

            if (selectedPaymentType === 'VISA') {
                visaInputs.style.display = 'block';
            } else if (selectedPaymentType === 'PAYPAL') {
                paypalInputs.style.display = 'block';
            } else if (selectedPaymentType === 'MBWAY') {
                mbwayInputs.style.display = 'block';
            }
        }

        paymentTypeSelect.addEventListener('change', toggleInputs);
        toggleInputs(); // Initialize based on current value
    });
</script>
@endsection
