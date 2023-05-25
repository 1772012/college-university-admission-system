{{-- Faculty table --}}
<div class="card border-0 card-rounded shadow-lg">
    <div class="card-body">

        {{-- Table --}}
        <div class="table-responsive">
            <table id="faculties-datatables" data-source="{{ route('faculties.datatables') }}" class="table table-striped w-100">
                <thead class="font-xs text-maranatha-blue text-uppercase"></thead>
            </table>
        </div>

    </div>
</div>
