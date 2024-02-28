<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{ isset($page_title) ? $page_title : ucwords(end($breadcrumbs)) }}
    </div>
    <div class="ps-sm-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a></li>
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (is_numeric($breadcrumb))
                        <li class="breadcrumb-item" aria-current="page">{{ isset($page_title) ? $page_title : $breadcrumb }}</li>
                    @else
                        <li class="breadcrumb-item" aria-current="page">
                            {{ ucwords(str_replace(['_', '-'], ' ', $breadcrumb)) }}
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        @yield('top-btn')
    </div>
</div>
