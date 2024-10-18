<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('initial_password') is-invalid @enderror" name="initial_password"
        id="inputPassword" value="{{ old('initial_password', '123') }}">
    <label for="inputPassword" class="form-label">Initial Password</label>
    @error('initial_password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
