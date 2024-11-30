<div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10']) }}>
    @foreach ($theaters as $theater)
        <div class="bg-white  rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 flex flex-col justify-between relative z-10">
            <a href="{{ route('theaters.show', ['theater' => $theater]) }}" class="flex justify-center">
            <h3 class="text-xl font-bold text-gray-900  truncate">{{ $theater->name }}</h3>
            <div class="flex justify-end mt-4 space-x-2">
                @if ($showEdit)
                    <x-table.icon-edit href="{{ route('theaters.edit', ['theater' => $theater]) }}" />
                @endif
                @if ($showDelete)
                    <x-table.icon-delete action="{{ route('theaters.destroy', ['theater' => $theater]) }}" />
                @endif
            </div>
            </a>
        </div>
    @endforeach
</div>
