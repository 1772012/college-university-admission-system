{{-- Delete application button --}}
<a class="btn btn-circle btn-delete-application text-danger" href="{{ route('applications.destroy', ['application' => $model]) }}" role="button">
    <i class="fas fa-trash"></i>
</a>
