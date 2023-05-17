{{-- Checkbox container --}}
@php
    $componentAttr = $attributes->merge([
        'class' => $title ? 'form-group' : null,
    ]);
@endphp

<div {{ $componentAttr }}>

    {{-- Label --}}
    @if ($title)
        <label for="{{ $id }}">
            <span>{{ $title }}</span>
        </label>
    @endif

    {{ $slot }}

    {{-- Help --}}
    @if ($help)
        <small class="text-muted">{{ $help }}</small>
    @endif

</div>
