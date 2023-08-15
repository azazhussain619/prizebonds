@props(['name', 'value'])

<textarea id="{{ $name }}" class="form-control @error( $name ) is-invalid @enderror"
          name="{{ $name }}" autocomplete="{{ $name }}" autofocus {{ $attributes }}>{{ $value ?? old($name) }}</textarea>
@error( $name )
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
