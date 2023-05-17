{{-- Edit user form --}}
<form action="{{ route('users.update', ['user' => $model]) }}" method="POST">
    @csrf

    {{-- Email --}}
    <x-utils.forms.form-row-email required label="Email" id="email" name="email" icon="fa-envelope" :value="$model->email" />

    {{-- Name --}}
    <x-utils.forms.form-row-text required label="Nama Lengkap" id="name" name="name" :value="$model->userDetail->name" />

</form>
