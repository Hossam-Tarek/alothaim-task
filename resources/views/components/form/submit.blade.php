<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <input type="submit" class="btn btn-primary {{ $inputClass }}" value="{{ $slot }}">

    @if($cancel)
        <a href="{{ $redirectRoute }}" class="btn btn-danger">{{ __("Cancel") }}</a>
    @endif
</div>
