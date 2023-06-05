{{-- Predict application button --}}
<a class="btn btn-circle btn-predict-application text-{{ $model->applicationStudyPrograms->first()->is_processed ? 'success' : 'dark' }}" href="{{ route('applications.predict', ['application' => $model]) }}" role="button">
    <i class="fas fa-cogs"></i>
</a>
