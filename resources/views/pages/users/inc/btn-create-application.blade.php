{{-- Create application button --}}
@if ($model->grades->isNotEmpty())
    <a class="btn btn-circle text-{{ $model->applications->isNotEmpty() ? 'maranatha-blue' : 'dark' }}" href="{{ route('applications.create', ['user' => $model]) }}" role="button">
        <i class="fas fa-file-circle-plus"></i>
    </a>
@endif
