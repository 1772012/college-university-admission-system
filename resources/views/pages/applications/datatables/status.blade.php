<i class="fas fa-check text-{{ $model->applicationStudyPrograms->first()->is_processed ? 'success' : 'dark' }}"
    style="width: 1em;" data-toggle="tooltip" title="{{ $model->applicationStudyPrograms->first()->is_processed ? 'Sudah diproses' : 'Belum diproses' }}"></i>
@if ($model->applicationStudyPrograms->first()->is_accepted !== null)
    <i class="fas fa-check-double text-{{ $model->applicationStudyPrograms->first()->is_accepted ? 'success' : 'danger' }}"
        style="width: 1em;" data-toggle="tooltip" title="{{ $model->applicationStudyPrograms->first()->is_accepted ? 'Diterima' : 'Ditolak' }}"></i>
@else
    <i class="fas fa-check-double text-dark" style="width: 1em;" data-toggle="tooltip" title="Belum ada status"></i>
@endif
