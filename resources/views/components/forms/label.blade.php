<label {{ $attributes->merge(['class' => 'mb-1']) }} for="{{ $fieldId }}">{{ $fieldLabel }}
    @if ($fieldRequired == 'true')
        <sup class="mr-1">*</sup>
    @endif
</label>
