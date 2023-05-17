{{-- Color --}}
<div class="form-group with-validation mb-3">
    <label for="{{ $id }}">
        <span>{{ $label }}</span>
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="input-group">
        @if (!empty($icon))
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa {{ $icon }} fa-sm" style="width: 1em;"></i></span>
            </div>
        @endif
        <input {{ $required ? 'required' : null }} type="color"
            class="form-control {{ $size ? 'form-control-' . $size : null }}" id="{{ $id }}"
            name="{{ $name }}" value="{{ $value }}">
    </div>
</div>
