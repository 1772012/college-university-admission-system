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
            <select {{ $required ? 'required' : null }} {{ $dataSource ? 'data-source="' . $dataSource . '"' : null }}
                name="{{ $name }}" id="{{ $id }}" class="form-control">
                <option value="" disabled selected hidden>{{ $placeholder }}</option>
                @foreach ($list as $key => $optionLabel)
                    <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
                        {{ $optionLabel }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
