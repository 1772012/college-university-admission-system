{{-- Users table --}}
<div class="card border-0 card-rounded shadow-lg">
    <div class="card-body">

        {{-- Create user button --}}
        @include('pages.users.inc.btn-create-user')

        {{-- Table --}}
        <div class="table-responsive">
            <table id="users-datatables" data-source="{{ route('users.datatables') }}" class="table table-striped w-100">
                <thead class="font-xs text-maranatha-blue text-uppercase"></thead>
            </table>
        </div>

    </div>
</div>
