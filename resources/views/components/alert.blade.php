<div {{ $attributes->merge(['class' => 'alert alert-primary d-flex align-items-center alert-dismissible fade show']) }} role="alert">
    @if ($icon)
        <div class="me-2"><i class="fa fa-{{ $icon }}"></i></div>
    @endif
    <div>
        {{ $text }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
