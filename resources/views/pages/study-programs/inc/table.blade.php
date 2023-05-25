{{-- Study programs table --}}
<div class="card border-0 card-rounded shadow-lg">
    <div class="card-body">

        {{-- Table --}}
        <div class="table-responsive">
            <table id="study-programs-datatables" data-source="{{ route('study-programs.datatables') }}" class="table table-striped w-100">
                <thead class="font-xs text-maranatha-blue text-uppercase"></thead>
            </table>
        </div>

    </div>
</div>
