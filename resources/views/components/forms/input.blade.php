@props(['type' => 'text', 'name', 'value'])

<input id="{{ $name }}" type="{{ $type }}" class="form-control @error( $name ) is-invalid @enderror"
       name="{{ $name }}" value="{{ $value ?? old($name) }}" autocomplete="{{ $name }}" autofocus {{ $attributes }}>

@error( $name )
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
