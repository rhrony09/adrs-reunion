<li>
    <a class="dropdown-item" href="{{ $link }}">
        @if ($icon != '')
            <i class="fa fa-{{ $icon }}"></i>
        @endif {{ $slot }}
    </a>
</li>
