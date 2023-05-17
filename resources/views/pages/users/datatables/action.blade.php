{{-- Action --}}
<div class="dropdown show">

    <a class="btn btn-circle dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown">
        <i class="fas fa-cogs"></i>
    </a>

    <div class="dropdown-menu shadow-lg">

        {{-- Edit user button --}}
        @include('pages.users.inc.btn-edit-user')

        {{-- Delete user button --}}
        @include('pages.users.inc.btn-delete-user')

    </div>
</div>
