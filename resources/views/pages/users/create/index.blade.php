{{-- Create user form --}}
<form action="{{ route('users.store') }}" method="POST">
    @csrf

    {{-- Email --}}
    <x-utils.forms.form-row-email required label="Email" id="email" name="email" icon="fa-envelope" />

    {{-- Name --}}
    <x-utils.forms.form-row-text required label="Nama Lengkap" id="name" name="name" />

    {{-- Password --}}
    <x-utils.forms.form-row-password required label="Password" id="password" name="password" />

</form>
