<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 ">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <x-field.image name="photo_file" label="Photo" width="md" deleteTitle="Delete Photo" :deleteAllow="false"
            :imageUrl="$user->photoFullUrl" />
        <a href="{{ route('profile.photo.destroy') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete your profile photo?');">
            Delete Photo
        </a>

        @if ($user->type != 'A')
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Nif')" />
            <x-text-input id="nif" name="nif" type="text" class="mt-1 block w-full" :value="old('nif', $user->customer?->nif)"
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="mb-4">
            <x-input-label for="payment_type" :value="__('Payment Type')" />
            <select id="payment_type" name="payment_type"
                class="mt-1 block w-full @error('payment_type') border-red-500 @enderror"
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
        <div>
            <x-input-label for="name" :value="__('Payment Ref')" />
            <x-text-input id="payment_ref" name="ref" type="text" class="mt-1 block w-full" :value="old('payment_ref', $user->customer?->payment_ref)"
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        @endif
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 ">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600  hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 ">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 ">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
