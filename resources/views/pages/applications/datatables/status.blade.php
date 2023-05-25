
<span class="badge badge-pill badge-{{ $model->applicationStudyPrograms->first()->is_processed ? 'success' : 'dark' }}">
    <i class="fas fa-check" style="width: 1em;" data-toggle="tooltip"
        title="{{ $model->applicationStudyPrograms->first()->is_processed ? 'Sudah diproses' : 'Belum diproses' }}"></i>
        <span>{{ $model->applicationStudyPrograms->first()->is_processed ? 'Sudah diproses' : 'Belum diproses' }}</span>
</span>

@if ($model->applicationStudyPrograms->first()->is_accepted != null)
    <span
        class="badge badge-pill badge-{{ $model->applicationStudyPrograms->first()->is_processed ? 'success' : 'dark' }}">
        <i class="fas fa-check-double" style="width: 1em;" data-toggle="tooltip"
            title="{{ $model->applicationStudyPrograms->first()->is_accepted ? 'Diterima' : 'Ditolak' }}"></i>
            <span>{{ $model->applicationStudyPrograms->first()->is_accepted ? 'Diterima' : 'Ditolak' }}</span>
    </span>
@else
    <span class="badge badge-pill badge-dark">
        <i class="fas fa-check-double" style="width: 1em;" data-toggle="tooltip" title="Belum ada status"></i>
        <span>Belum ada status</span>
    </span>
@endif
