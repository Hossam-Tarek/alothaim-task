<div {{ $attributes->merge(['class' => 'form-group']) }}>
    @if($label)
        <label for="{{ $name }}">{{ $slot }}</label>
    @endif
    <textarea class="form-control {{ $inputClass }} @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
              placeholder="{{ $slot }}" {{ $attributes }}>{!! $value ?? old($name) !!}</textarea>

    @error(str_contains($name, '[') ? str_replace(['[', ']'], ['.', ''], $name) : $name)
    <p class="help text-danger">{{ $errors->first(str_replace(['[', ']'], ['.', ''], $name)) }}</p>
    @enderror
</div>
