{{-- Checkbox item --}}
<div {{ $attributes->merge(['class' => 'd-inline mb-4 ' . $type]) }}>

    {{-- Checkbox --}}
    <input {{ $checked ? 'checked' : null }} {{ $disabled ? 'disabled' : null }} type="checkbox"
        class="form-check-input" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">

    {{-- Label --}}
    <label for="{{ $id }}">{{ $title }}</label>

</div>