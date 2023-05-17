{{-- Form row text --}}
<div class="form-row">
    <div class="col-sm-4">
        <label for="{{ $id }}">
            <span>{{ $label }}</span>
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    </div>
    <div class="col-sm-8 with-validation mb-3">
        <div class="input-group">
            @if (!empty($icon))
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa {{ $icon }} fa-sm" style="width: 1em;"></i></span>
                </div>
            @endif
            <input {{ $required ? 'required' : null }} type="text" class="form-control" id="{{ $id }}"
                name="{{ $name }}" value="{{ $value }}">
        </div>
    </div>
</div>
