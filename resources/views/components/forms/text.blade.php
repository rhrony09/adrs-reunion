<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired"></x-forms.label>
    <input type="text" class="form-control" value="{{ $fieldValue }}" name="{{ $fieldName }}" id="{{ $fieldId }}" @if ($fieldRequired == 'true') required @endif>
</div>
