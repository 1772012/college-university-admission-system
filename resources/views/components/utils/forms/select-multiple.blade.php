{{-- Select multiple --}}
@props([
    'required' => false,
    'label' => '',
    'id' => '',
    'name' => '',
    'list' => [],
    'dataSource' => '',
    'icon' => '',
    'value' => '',
])

<div class="form-group with-validation mb-3">
    <label for="{{ $id }}">
        <span>{{ $label }}</span>
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="input-group">
        @if (isset($icon) && !empty($icon))
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa {{ $icon }} fa-sm" style="width: 1em;"></i></span>
            </div>
        @endif
        <select multiple="multiple" {{ $required ? 'required' : null }}
            {{ $dataSource ? 'data-source="' . $dataSource . '"' : null }} name="{{ $name }}"
            id="{{ $id }}" class="form-control">
            @foreach ($list as $key => $optionLabel)
                <option value="{{ $key }}" {{ in_array($key, $value) ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#{{ $id }}").select2({
                theme: "bootstrap4"
            });
        });
    </script>
@endpush
