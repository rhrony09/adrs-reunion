<label {{ $attributes->merge(['class' => 'mb-1']) }} for="{{ $fieldId }}">{{ $fieldLabel }}
    @if ($fieldRequired == 'true')
        <sup class="mr-1">*</sup>
    @endif

    @if (!is_null($popover))
        <i class="fa fa-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $popover }}"></i>
    @endif
</label>
