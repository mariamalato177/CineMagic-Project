{{--
    NOTE: we've used the match to define multiple versions of the button (by Type),
    to ensure that all specific color related classes are defined statically
    on the source code - this guarantees that the Tailwind builder
    detects the corresponding class.
    If we had used dynamically generated classes (e.g. "bg-{{ $color }}-800") then
    the builder would not detect concrete values.
    Check documentation about dynamic classes:
    https://tailwindcss.com/docs/content-configuration#dynamic-class-names
--}}
@php
    $colors = match($type) {
        'primary' => 'text-white
                        bg-blue-600
                        hover:bg-blue-700
                        focus:bg-blue-700
                        active:bg-blue-800',
        'secondary' => 'text-white
                        bg-gray-500
                        hover:bg-gray-600
                        focus:bg-gray-600
                        active:bg-gray-700 ',
        'success' => 'text-white
                        bg-green-700
                        hover:bg-green-800
                        focus:bg-green-800
                        active:bg-green-900',
        'danger' => 'text-white
                        bg-red-600
                        hover:bg-red-700
                        focus:bg-red-700
                        active:bg-red-800 ',
        'warning' => 'text-gray-900
                        bg-amber-400
                        hover:bg-amber-300
                        focus:bg-amber-300
                        active:bg-amber-300',
        'info' => 'text-gray-900
                        bg-cyan-400
                        hover:bg-cyan-300
                        focus:bg-cyan-300
                        active:bg-cyan-300 ',
        'light' => 'text-gray-900
                        bg-slate-50
                        hover:bg-slate-200
                        focus:bg-slate-200
                        active:bg-slate-200 ',
        'link' => 'text-blue-500
                        border-gray-200',
        default => 'text-white
                        bg-gray-800
                        hover:bg-gray-900
                        focus:bg-gray-900
                        active:bg-gray-950',
    }
@endphp
<div {{ $attributes }}>
    @if ($element == 'a')
        <a href="{{ $href }}"
            class="px-4 py-2 inline-block border border-transparent rounded-md
                    font-medium text-sm tracking-widest
                    focus:outline-none focus:ring-2
                    focus:ring-indigo-500
                    focus:ring-offset-2 transition ease-in-out duration-150 {{ $colors }}">
            {{ $text }}
        </a>
    @else
        <button type="{{ $element }}" {{ $buttonName ? "name='$buttonName'" : '' }}
            class="px-4 py-2 inline-block border border-transparent rounded-md
                    font-medium text-sm tracking-widest
                    focus:outline-none focus:ring-2
                    focus:ring-indigo-500
                    focus:ring-offset-2 transition ease-in-out duration-150 {{ $colors }}">
            {{ $text }}
        </button>
    @endif
</div>
