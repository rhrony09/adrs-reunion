<button @if ($disabled) disabled @endif {{ $attributes->merge(['class' => 'btn btn-primary mt-2', 'type' => 'button']) }}>
    @if ($icon != '')
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</button>
