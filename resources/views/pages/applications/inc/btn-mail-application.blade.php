{{-- Mail application button --}}
@if ($model->is_processed)
    <a class="btn btn-circle btn-mail-application text-primary" href="{{ route('applications.mail', ['application' => $model]) }}" role="button">
        <i class="fas fa-paper-plane"></i>
    </a>
@endif
