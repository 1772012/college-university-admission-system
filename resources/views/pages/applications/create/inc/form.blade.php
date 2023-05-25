{{-- Create application form --}}
<form id="form" action="{{ route('applications.store', ['user' => $user]) }}" method="POST">
    @csrf

    <div class="card card-rounded shadow-sm border-0 mb-4">
        <div class="card-body">

            {{-- Faculty --}}
            <x-utils.forms.form-row-select required icon="fa-building" label="Fakultas" id="faculty" name="faculty"
                placeholder="Pilih fakultas..." :list="$faculties" />

            {{-- Study program --}}
            <div id="form--study-program" data-source="{{ route('applications.get-study-programs') }}" class="hidden">
                <x-utils.forms.form-row-select required icon="fa-graduation-cap" label="Program Studi" id="study-program" name="study-program"
                    placeholder="Pilih program studi..." :list="[]" />
            </div>

            {{-- Submit button --}}
            <div id="form--submit" class="hidden">
                <hr>

                <div class="text-right">
                    <button role="button" type="button" class="btn btn-create-application btn-success rounded-pill shadow-lg"
                        redirect-to="{{ route('applications.index') }}" >
                        <span>Buat Peserta Baru</span>
                    </button>
                </div>

            </div>

        </div>
    </div>
</form>
