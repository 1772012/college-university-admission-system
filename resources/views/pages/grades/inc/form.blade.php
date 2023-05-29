{{-- Grades form --}}
<form id="form" action="{{ route('grades.store', ['user' => $user]) }}" method="POST">
    @csrf

    <div class="card card-rounded shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>

                        {{-- Matematika --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName'   => 'Matematika',
                            'subjectCase'   => 'matematika'
                        ])

                        {{-- Bahasa inggris --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Bahasa Inggris',
                            'subjectCase' => 'bahasa-inggris',
                        ])

                        {{-- Bahasa indonesia --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Bahasa Indonesia',
                            'subjectCase' => 'bahasa-indonesia',
                        ])

                        {{-- Fisika --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Fisika',
                            'subjectCase' => 'fisika',
                        ])

                        {{-- Kimia --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Kimia',
                            'subjectCase' => 'kimia',
                        ])

                        {{-- Biologi --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Biologi',
                            'subjectCase' => 'biologi',
                        ])

                        {{-- Geografi --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Geografi',
                            'subjectCase' => 'geografi',
                        ])

                        {{-- Sosiologi --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Sosiologi',
                            'subjectCase' => 'sosiologi',
                        ])

                        {{-- Ekonomi --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Ekonomi',
                            'subjectCase' => 'ekonomi',
                        ])

                        {{-- Bahasa mandarin --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Bahasa Mandarin',
                            'subjectCase' => 'bahasa-mandarin',
                        ])

                        {{-- Bahasa jepang --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Bahasa Jepang',
                            'subjectCase' => 'bahasa-jepang',
                        ])

                        {{-- Bahasa korea --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Bahasa Korea',
                            'subjectCase' => 'bahasa-korea',
                        ])

                        {{-- Bahasa jerman --}}
                        @include('pages.grades.inc.grade-form-row', [
                            'subjectName' => 'Bahasa Jerman',
                            'subjectCase' => 'bahasa-jerman',
                        ])

                    </tbody>
                </table>
            </div>

            {{-- Submit button --}}
            <div id="form--submit">
                <hr>

                <div class="text-right">
                    <button role="button" type="button"
                        class="btn btn-create-grades btn-success rounded-pill shadow-lg"
                        redirect-to="{{ route('users.index') }}">
                        <span>Simpan Nilai Rapor</span>
                    </button>
                </div>

            </div>

        </div>
    </div>
</form>
