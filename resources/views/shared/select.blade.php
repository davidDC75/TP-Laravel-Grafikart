@php
    $class ??= null;
    $label ??= 'Default Label';
    $name ??= 'options';

    $multiple ??= false;
@endphp
<div @class([ 'form-group', $class])>
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}[]" id="{{ $name }}" @if($multiple==true) multiple @endif>
        @foreach($options as $k => $v)
            <option @selected($value->contains($k)) value="{{ $k }}">{{ $v }}</option>
        @endforeach
    </select>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
