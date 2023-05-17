{{-- Radio item --}}
<div class="{{ $inline ? 'd-inline' : null }} mr-2 {{ $type }}">

    {{-- Radio Button --}}
    <input {{ $checked ? 'checked' : null }} {{ $disabled ? 'disabled' : null }} {{ $required ? 'required' : null }}
        type="radio" class="form-check-input" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">

    {{-- Label --}}
    <label for="{{ $id }}" class="{{ $title ?? 'hidden p-0 m-0' }}">
        {{ $title }}
    </label>

</div>
