<div {{ $attributes->merge(['class' => 'form-group']) }}>
    @if($label)
        <label for="{{ $name }}" class="{{ $labelClass }}">{{ $slot }}</label>
    @endif
    <input type="{{ $type }}" class="form-control {{ $inputClass }} @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
           placeholder="{{ $slot }}" value="{{ $value ?? old($name) }}" {{ $attributes }}>

    @error(str_contains($name, '[') ? str_replace(['[', ']'], ['.', ''], $name) : $name)
        <p class="help text-danger">{{ $errors->first(str_replace(['[', ']'], ['.', ''], $name)) }}</p>
    @enderror
</div>
