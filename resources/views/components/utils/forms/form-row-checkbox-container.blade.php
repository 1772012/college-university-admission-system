{{-- Form row checkbox container --}}
<div class="form-row">
    <div class="col-sm-4">
        <label for="{{ $id }}">
            <span>{{ $title }}</span>
        </label>
    </div>
    <div class="col-sm-8 with-validation">
        <div class="form-group">
            {{ $slot }}
        </div>
        @if ($help)
            <small class="text-muted">{{ $help }}</small>
        @endif
    </div>
</div>
