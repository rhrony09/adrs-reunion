<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired" :popover="$popover"></x-forms.label>
    <select name="{{ $fieldName }}" id="{{ $fieldId }}" @if ($multiple) multiple @endif class="form-select select-picker" @if ($fieldRequired == 'true') required @endif>
        {!! $slot !!}
    </select>
</div>
