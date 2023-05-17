{{-- Radio container --}}
<div class="{{ $title ? 'form-radio-group' : null }}">

    {{-- Label --}}
    @if ($title)
        <label>
            @if ($required)
                <span class="text-danger">*</span>
            @endif
            <span>{{ $title }}</span>
        </label>
    @endif

    {{-- Form group --}}
    <div class="form-group">
        {{ $slot }}
    </div>

    {{-- Help --}}
    @if ($help)
        <small class="text-muted">{{ $help }}</small>
    @endif

</div>
