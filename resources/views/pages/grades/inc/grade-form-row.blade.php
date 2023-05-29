{{-- Grade form row --}}
<tr class="subject" subject-name="{{ $subjectName }}">
    <td class="font-weight-bold">{{ $subjectName }}</td>
    <td>
        <label for="">Nilai (Ganjil)</label>
        <input type="number" id="{{ $subjectCase }}-value-odd" name="{{ $subjectCase }}-value-odd" class="form-control is-value-semester-odd" min="0"
            max="100" value="{{ $user->getGradeBySubject($subjectName, 'Ganjil')->value ?? null }}">
    </td>
    <td>
        <label for="">KKM (Ganjil)</label>
        <input type="number" id="{{ $subjectCase }}-kkm-odd" name="{{ $subjectCase }}-kkm-odd" class="form-control  is-kkm-semester-odd" min="0"
            max="100" value="{{ $user->getGradeBySubject($subjectName, 'Ganjil')->kkm ?? null }}">
    </td>
    <td>
        <label for="">Nilai (Genap)</label>
        <input type="number" id="{{ $subjectCase }}-value-even" name="{{ $subjectCase }}-value-even" class="form-control is-value-semester-even"
            min="0" max="100" value="{{ $user->getGradeBySubject($subjectName, 'Genap')->value ?? null }}">
    </td>
    <td>
        <label for="">KKM (Genap)</label>
        <input type="number" id="{{ $subjectCase }}-kkm-even" name="{{ $subjectCase }}-kkm-even" class="form-control is-kkm-semester-even" min="0"
            max="100" value="{{ $user->getGradeBySubject($subjectName, 'Genap')->kkm ?? null }}">
    </td>
</tr>
