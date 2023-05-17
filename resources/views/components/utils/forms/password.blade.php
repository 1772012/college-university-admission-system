{{-- Password --}}
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
        <input {{ $required ? 'required' : null }} type="password"
            class="form-control {{ $size ? 'form-control-' . $size : null }}" id="{{ $id }}"
            name="{{ $name }}">
        <div class="input-group-append password-toggle">
            <span class="input-group-text"><i class="fa fa-eye password-icon" style="width: 1em;"></i></span>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.password-toggle').on('click', function() {
                const $passwordInput = $(this).closest('.input-group').find('input');
                const inputType = $passwordInput.attr('type') === 'password' ? 'text' : 'password';
                $passwordInput.attr('type', inputType);
                $('.password-icon').toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>
@endpush

