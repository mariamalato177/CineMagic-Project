@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp
<x-field.input name="name" label="name" width="md" :readonly="$readonly || $mode == 'edit'" value="{{ old('name', $theater->name) }}" />
<x-field.input name="custom" label="custom" :readonly="$readonly" value="{{ old('custom', $theater->custom) }}" />

