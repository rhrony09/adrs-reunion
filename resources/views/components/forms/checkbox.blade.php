<div class="form-check">
    <input {{ $attributes->merge(['class' => 'form-check-input']) }} type="checkbox" @isset($fieldValue)
        value="{{ $fieldValue }}" @endisset name="{{ $fieldName }}" @if ($checked) checked @endif id="{{ $fieldId }}">
    @if ($fieldLabel != '')
        <label class="form-check-label me-3 justify-content-start text-wrap" for="{{ $fieldId }}">
            {{ $fieldLabel }}
            @if (!is_null($popover))
                <i class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-html="true" data-content="{{ $popover }}" data-trigger="hover"></i>
            @endif
        </label>
    @endif
</div>
