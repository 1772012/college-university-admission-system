{{-- Form row file --}}
<div class="form-row">
    <div class="col-sm-4">
        <label for="{{ $id }}">
            <span>{{ $label }}</span>
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    </div>
    <div class="col-sm-8 with-validation mb-3">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="{{ $id }}" name="{{ $name }}"
                    {{ $required ? 'required' : '' }} accept="{{ $accept }}">
                <label class="custom-file-label" id="label-{{ $id }}-placeholder" for="{{ $id }}">Choose File</label>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    const fileInput = document.querySelector('#{{ $id }}');
    fileInput.addEventListener('change', function(e) {
        e.preventDefault();
        const fullPath = fileInput.value;
        if (fullPath) {
            const startIndex = fullPath.lastIndexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/');
            let filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            const label = document.querySelector('#label-{{ $id }}-placeholder');
            label.innerHTML = '';
            label.appendChild(document.createTextNode(filename));
        }
    });
</script>
