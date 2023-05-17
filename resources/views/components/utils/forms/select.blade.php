@props([
    'required' => false,
    'label' => '',
    'id' => '',
    'name' => '',
    'list' => [],
    'dataSource' => '',
    'placeholder' => '',
    'icon' => '',
    'value' => '',
])

<div class="form-group with-validation mb-3">
    @if ($label)
        <label for="{{ $id }}">
            <span>{{ $label }}</span>
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <div class="input-group">
        @if (isset($icon) && !empty($icon))
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa {{ $icon }} fa-sm" style="width: 1em;"></i></span>
            </div>
        @endif
        <select {{ $required ? 'required' : null }} {{ $dataSource ? 'data-source="' . $dataSource . '"' : null }}
            name="{{ $name }}" id="{{ $id }}" class="select2 form-control">
            @if ($placeholder)
                <option value="" disabled selected hidden>{{ $placeholder }}</option>
            @endif
            @if ($list)
                @foreach ($list as $key => $optionLabel)
                    <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
                        {{ $optionLabel }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#{{ $id }}").select2({
                theme: "bootstrap4",
            });
        });
    </script>
@endpush
