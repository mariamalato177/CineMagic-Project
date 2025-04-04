@php
    $widthClass = match ($width) {
        'full' => 'w-full',
        'xs' => 'w-20',
        'sm' => 'w-32',
        'md' => 'w-64',
        'lg' => 'w-96',
        'xl' => 'w-[48rem]',
        '1/3' => 'w-1/3',
        '2/3' => 'w-2/3',
        '1/4' => 'w-1/4',
        '2/4' => 'w-2/4',
        '3/4' => 'w-3/4',
        '1/5' => 'w-1/5',
        '2/5' => 'w-2/5',
        '3/5' => 'w-3/5',
        '4/5' => 'w-4/5',
        default => 'w-full',
    };
@endphp

@props([
    'name',
    'label',
    'value' => '',
    'width' => 'full',
    'required' => false,
    'readonly' => false,
])

@php
    $widthClass = match ($width) {
        'full' => 'w-full',
        'xs' => 'w-20',
        'sm' => 'w-32',
        'md' => 'w-64',
        'lg' => 'w-96',
        'xl' => 'w-[48rem]',
        '1/3' => 'w-1/3',
        '2/3' => 'w-2/3',
        '1/4' => 'w-1/4',
        '2/4' => 'w-2/4',
        '3/4' => 'w-3/4',
        '1/5' => 'w-1/5',
        '2/5' => 'w-2/5',
        '3/5' => 'w-3/5',
        '4/5' => 'w-4/5',
        default => 'w-full',
    };
@endphp

<div {{ $attributes->merge(['class' => "$widthClass"]) }}>
    <label class="block font-medium text-sm text-gray-700 " for="id_{{ $name }}">
        {{ $label }}
    </label>
    <input id="id_{{ $name }}" name="{{ $name }}" type="time" value="{{ $value }}"
        class="appearance-none block
            mt-1 w-full
            bg-white
            text-black
            @error($name)
                border-red-500
            @else
                border-gray-300
            @enderror
            focus:border-indigo-500
            focus:ring-indigo-500
            rounded-md shadow-sm
            disabled:rounded-none disabled:shadow-none
            disabled:border-t-transparent disabled:border-x-transparent
            disabled:border-dashed
            disabled:opacity-100
            disabled:select-none"
        @required($required) @disabled($readonly) autofocus="autofocus">
    @error($name)
        <div class="text-sm text-red-500"> {{ $message }} </div>
    @enderror
</div>
