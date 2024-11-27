@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
    $theaters = App\Models\Theater::all();
@endphp
<h2>
    {{ $mode == 'create' ? 'Create new screening for movie' : "Edit Screening of the movie \"{$screening->movieRef->title}\" at {$screening->theaterRef->name} on {$screening->date} {$screening->start_time}" }}
</h2>
{{--
    <x-field.input name="movie" label="Movie" width="md" readonly="$readonly"
        value="{{ old('movie', $screening->movieRef->title) }}" />
    <x-field.input name="theater" label="Theater" width="md" readonly="$readonly"
        value="{{ old('theater', $screening->theaterRef->name) }}" />
 --}}
<div>
    <label for="movie_id">Movie</label>
    <select name="movie_id" required>
        @foreach($movies as $movie)
            <option value="{{ $movie['id'] }}">{{ $movie['title'] }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="theater_id">Theater</label>
    <select name="theater_id" required>
        @foreach($theaters as $theater)
            <option value="{{ $theater->id }}">{{ $theater->name }}</option>
        @endforeach
    </select>
</div>

<x-field.input name="custom" label="Custom" width="md" :readonly="$readonly"
    value="{{ old('custom', $screening->custom) }}" />
