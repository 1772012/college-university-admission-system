{{-- Navbar --}}
<li class="nav-item {{ $isActive ? 'active' : null }}">
    <a class="nav-link" href="{{ $href }}">
        <i class="fas fa-fw {{ $icon }}" style="width: 2em;"></i>
        <span>{{ $title }}</span>
    </a>
</li>
