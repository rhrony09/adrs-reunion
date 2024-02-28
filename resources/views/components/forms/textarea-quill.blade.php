<div {{ $attributes->merge(['class' => 'mt-3']) }} id="{{ $fieldId }}-area">
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :popover="$popover"></x-forms.label>
    <div class="quill-editor" id="{{ $fieldId }}-quill">{!! $fieldValue !!}</div>
    <textarea class="d-none" name="{{ $fieldName }}" id="{{ $fieldId }}">{{ $fieldValue }}</textarea>
</div>

<script>
    document.getElementById('{{ $fieldId }}-quill').addEventListener('keyup', function() {
        document.getElementById('{{ $fieldId }}').value = document.getElementById('{{ $fieldId }}-quill').children[0].innerHTML.replace('<p><br></p>', '');
    });

    document.getElementById('{{ $fieldId }}-area').addEventListener('click', function() {
        document.getElementById('{{ $fieldId }}').value = document.getElementById('{{ $fieldId }}-quill').children[0].innerHTML.replace('<p><br></p>', '');
    });
</script>
