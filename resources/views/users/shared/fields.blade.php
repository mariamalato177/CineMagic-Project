@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required
            autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>
    <div>
        <x-input-label for="nif" :value="__('Nif')" />
        <x-text-input id="nif" name="nif" type="text" class="mt-1 block w-sm" :value="old('nif', $user->customer?->nif)" />
        <x-input-error class="mt-2" :messages="$errors->get('nif')" />
    </div>
    <x-input-label class="" for="payment" :value="__('Payment Details')" />
    <div>
        <x-text-input id="payment" name="payment" type="text" class="mt-1 block w-sm" :value="old('payment_type', $user->customer?->payment_type)" />
        <x-input-error class="mt-2" :messages="$errors->get('payment')" />

        <x-text-input id="payment" name="payment" type="text" class="mt-1 block w-sm" :value="old('payment_ref', $user->customer?->payment_ref)" />
        <x-input-error class="mt-2" :messages="$errors->get('payment')" />
    </div>
</div>
