@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp

<div class="container mx-auto mt-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <x-field.image name="poster_filename" label="Poster" width="md" :readonly="$readonly" deleteTitle="Delete Photo"
                :deleteAllow="false" deleteForm="form_to_delete_photo" :imageUrl="$movie->image_url" />
                
        </div>
        <div class="col-span-2 space-y-4">
            <div>
                <x-field.input name="title" label="Title" width="md" :readonly="$readonly" value="{{ old('title', $movie->title) }}" />
            </div>
            <div>
                <x-field.input name="year" label="Year" width="md" :readonly="$readonly" value="{{ old('year', $movie->year) }}" />
            </div>
            <div>
                <x-field.input name="trailer_url" label="Trailer" width="md" :readonly="$readonly"
                    value="{{ old('trailer_url', $movie?->trailer_url) }}" />
            </div>
            <div>
                @if($mode == 'edit')
                <select name="genre_code" id="inputGenre" class="border border-gray-700 bg-white text-black py-2 px-4 rounded flex-1">
                    @foreach ($genres->sortBy('name') as $genre)
                        <option value="{{ $genre->code }}" {{ $genre->code == $movie->genre_code ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            @else
                <select name="genre_code" id="inputGenre" class="border border-gray-700 bg-white text-black py-2 px-4 rounded flex-1" disabled>
                    @foreach ($genres->sortBy('name') as $genre)
                        <option value="{{ $genre->code }}" {{ $genre->code == $movie->genre_code ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            @endif

            </div>
            <div>
                <x-field.text-area name="custom" label="Custom" :readonly="$readonly" value="{{ old('custom', $movie->custom) }}" />
            </div>
            <div>
                <x-field.text-area name="synopsis" label="Synopsis" :readonly="$readonly" value="{{ old('synopsis', $movie->synopsis) }}" />
            </div>

        </div>
    </div>
</div>

<style>
    .container {
        max-width: 800px;
    }
</style>
