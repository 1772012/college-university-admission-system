{{-- Delete user button --}}
<a class="dropdown-item btn-delete-user" href="{{ route('users.destroy', ['user' => $model]) }}">
    <i class="fas fa-trash fa-sm text-danger mr-1" style="width: 1em;"></i>
    <span class="font-weight-bold">Hapus Akun Pendaftar</span>
</a>
