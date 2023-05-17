{{-- Form row text area --}}
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
        @if ($editor)
            <div id="{{ $id }}" class="document-editor shadow-sm">
                <div class="document-editor__toolbar"></div>
                <div class="document-editor__editable-container">
                    <div class="document-editor__editable">{!! $value !!}</div>
                </div>
            </div>
        @else
            <div class="input-group">
                @if (!empty($icon))
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa {{ $icon }} fa-sm" style="width: 1em;"></i></span>
                    </div>
                @endif
                <textarea {{ $required ? 'required' : null }} class="form-control w-100" value="{{ $value }}"
                    name="{{ $name }}" id="{{ $id }}" cols="{{ $cols }}" rows="{{ $rows }}">{{ $value }}</textarea>
            </div>
        @endif
    </div>
</div>
