{{-- Sidebar --}}
<ul class="navbar-nav bg-gradient-maranatha sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- Brand --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route('dashboard.index') }}">
        <span>Manajemen Admisi</span>
    </a>

    {{-- Divider --}}
    <hr class="sidebar-divider my-0">

    {{-- Dashboard --}}
    <x-utils.sidebar.navbar :is-active="$page == 'dashboard'" :href="route('dashboard.index')" icon="fa-tachometer-alt" title="Dasbor" />

    <hr class="sidebar-divider my-0">

    {{-- User --}}
    <x-utils.sidebar.navbar :is-active="$page == 'users'" :href="route('users.index')" icon="fa-user" title="Akun Pendaftar" />

    {{-- Application --}}
    <x-utils.sidebar.navbar :is-active="$page == 'applications'" :href="route('applications.index')" icon="fa-users" title="Peserta" />

    {{-- Divider --}}
    <hr class="sidebar-divider">

    {{-- Faculty --}}
    <x-utils.sidebar.navbar :is-active="$page == 'faculties'" :href="route('faculties.index')" icon="fa-building" title="Fakultas" />

    {{-- Study program --}}
    <x-utils.sidebar.navbar :is-active="$page == 'study-programs'" :href="route('study-programs.index')" icon="fa-graduation-cap" title="Program Studi" />

    {{-- Divider --}}
    <hr class="sidebar-divider d-none d-md-block">

    {{-- Sidebar toggler --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
