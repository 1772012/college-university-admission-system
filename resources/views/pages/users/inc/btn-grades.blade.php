{{-- Grades button --}}
<a class="btn btn-circle text-{{ $model->grades->isNotEmpty() ? 'maranatha-blue' : 'dark' }}" href="{{ route('grades.index', ['user' => $model]) }}" role="button">
    <i class="fas fa-star"></i>
</a>
