<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired" :popover="$popover"></x-forms.label>
    <textarea class="form-control" rows="4" placeholder="{{ $fieldPlaceholder }}" name="{{ $fieldName }}" id="{{ $fieldId }}" @if ($fieldRequired == 'true') required @endif>{{ $fieldValue }}</textarea>
</div>
