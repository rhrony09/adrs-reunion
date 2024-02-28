@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="socialmedia-form">
                @csrf
                <div class="row">
                    @foreach ($social_medias as $social_media)
                        <div class="col-md-6 mb-3">
                            <label for="site_name" class="form-label">{{ $social_media->name }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-brands {{ $social_media->icon }}"></i></span>
                                <input type="url" class="form-control" id="{{ $social_media->name }}" name="{{ $social_media->name }}" value="{{ $social_media->link }}"placeholder="Please enter the Url" autocomplete="off">
                            </div>
                            <div class="error" id="{{ $social_media->name }}-error"></div>
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save Social Media</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <style>
        form .error {
            font-size: .9em;
            color: #dc3545;
        }
    </style>
@endpush

@push('script')
    <script>
        $('#socialmedia-form').submit(function(e) {
            e.preventDefault();
            $('.error').html('');
            $('input').removeClass('is-invalid');
            $.ajax({
                method: 'POST',
                url: "{{ route('dashboard.social.media.update') }}",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        let field = '#' + key;
                        $(field).addClass('is-invalid');
                        $(field + '-error').html(value);
                    });
                }
            });
        });
    </script>
@endpush
