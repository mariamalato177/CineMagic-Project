@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3">
    <div class="form-check form-switch" {{ $disabledStr }}>
        <input type="hidden" name="user_type" value="E">
        <input type="checkbox" class="form-check-input @error('admin') is-invalid @enderror" name="user_type"
               id="inputAdmin" {{ $disabledStr }} {{ old('admin', $user->type) == 'A' ? 'checked' : '' }} value="A">
        <label for="inputAdmin" class="form-check-label">Admin</label>
        @error('admin')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
