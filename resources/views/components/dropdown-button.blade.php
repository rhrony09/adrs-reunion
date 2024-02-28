<li>
    <button {{ $attributes->merge(['class' => 'dropdown-item']) }}>
        @if ($icon != '')
            <i class="fa fa-{{ $icon }}"></i>
        @endif {{ $slot }}
    </button>
</li>
