{{-- Text --}}
<div class="form-group with-validation mb-3">
    @if ($label)
        <label for="{{ $id }}">
            <span>{{ $label }}</span>
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <div class="input-group date" id="datepicker-datetime-{{ $id }}" data-target-input="nearest">
        <input {{ $required ? 'required' : null }} type="text"
            class="form-control datetimepicker-input date {{ $size ? 'form-control-' . $size : null }}" id="{{ $id }}"
            name="{{ $name }}" value="{{ $value }}" data-target="#{{ $id }}" placeholder="{{ $placeholder }}">
        <div class="input-group-append" data-target="#{{ $id }}" data-toggle="datetimepicker">
            <span class="input-group-text">
                <i class="fas fa-calendar fa-sm" style="width: 1em;"></i>
            </span>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $("#{{ $id }}").datetimepicker({
            date: null,
            format: 'D/M/Y HH:mm'
        });
        $("#{{ $id }}").on("keypress", function (e) {
            e.preventDefault();
        });
    </script>
@endpush
