<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired"></x-forms.label>
    <input type="text" class="form-control" placeholder="{{ $fieldPlaceholder }}" value="{{ $fieldValue }}" name="{{ $fieldName }}" id="{{ $fieldId }}" @if ($fieldRequired == 'true') required @endif @if ($fieldReadOnly == 'true') readonly @endif>
    @if ($fieldHelp)
        <small id="{{ $fieldId }}Help" class="form-text text-muted">{{ $fieldHelp }}</small>
    @endif
</div>
