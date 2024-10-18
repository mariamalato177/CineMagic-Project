<div {{ $attributes->merge(['class' => 'grid grid-cols-1 lg:grid-cols-2 gap-6']) }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex flex-col sm:flex-row justify-between space-y-3 sm:space-y-0 sm:space-x-3">
            <div class="grow flex flex-col space-y-2">
                <div class="flex flex-col sm:flex-row sm:space-x-3">
                    <x-field.select name="genre" label="Genre" width="m" value="{{ $title }}" :options="$listGenres" />
                    <x-field.input name="title" label="Title of the Movie" width="m" value="{{ old('title', $title) }}" />
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-3">
                    <x-field.input name="synopsis" label="Synopsis" width="m" value="{{ old('synopsis', $synopsis) }}" />
                </div>
            </div>
            <div class="grow-0 flex flex-col space-y-3 justify-start">
                <div class="pt-6">
                    <x-button element="submit" type="dark" text="Filter" class="bg-coral-600 hover:bg-coral-500 text-white" />
                </div>
                <div>
                    <x-button element="a" type="light" text="Cancel" :href="$resetUrl" /> </div>
            </div>
        </div>
    </form>
</div>
