{{-- Title --}}
<div class="d-flex justify-content-between mb-4">
    <div class="h4 text-maranatha-blue font-weight-bold">
        <span class="text-uppercase">{{ $text }}</span>
    </div>
    @if ($breadcrumb)
        <nav>
            <ol class="breadcrumb py-2">
                {{ $breadcrumb }}
            </ol>
        </nav>
    @endif
</div>
