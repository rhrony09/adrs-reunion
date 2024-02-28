<li>
    <button {{ $attributes->merge(['class' => 'dropdown-item']) }} @if ($id != '') data-id="{{ $id }}" @endif>
        @if ($icon != '')
            <i class="fa fa-{{ $icon }}"></i>
        @endif {{ $slot }}
    </button>
</li>
