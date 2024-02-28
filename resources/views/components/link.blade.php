<a href="{{ $link }}" {{ $attributes->merge(['class' => 'btn btn-primary mt-2']) }} @if ($newTab == 'true') target="_blank" @endif>
    @if ($icon != '')
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</a>
