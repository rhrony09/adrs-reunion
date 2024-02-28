@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="settings" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="site_name" class="form-label">Site Name</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings->site_name }}"placeholder="Enter the Site Name">
                    <div class="error"></div>
                </div>
                <div class="mb-3">
                    <label for="site_tagline" class="form-label">Site Tagline</label>
                    <input type="text" class="form-control" id="site_tagline" name="site_tagline" value="{{ $settings->site_tagline }}" placeholder="Enter the Site Tagline">
                    <div class="error"></div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $settings->email }}" placeholder="Enter email address">
                            <div class="error"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone No</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $settings->phone }}" placeholder="Enter phone number">
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $settings->address }}" placeholder="Enter address">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="mb-3">
                            <label for="site_primary_color" class="form-label">Site Primary Color</label>
                            <div class="row">
                                <div class="col-2 col-md-3" style="padding-right: 5px">
                                    <div class="rounded-3" style="width: 100%; height: 100%; background: {{ $settings->site_primary_color }}"></div>
                                </div>
                                <div class="col-10 col-md-9" style="padding-left: 0px">
                                    <input type="text" class="form-control" id="site_primary_color" name="site_primary_color" value="{{ $settings->site_primary_color }}" placeholder="Enter the color code here">
                                    <div class="error"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="mb-3">
                            <label for="site_accent_color" class="form-label">Site Accent Color</label>
                            <div class="row">
                                <div class="col-2 col-md-3" style="padding-right: 5px">
                                    <div class="rounded-3" style="width: 100%; height: 100%; background: {{ $settings->site_accent_color }}"></div>
                                </div>
                                <div class="col-10 col-md-9" style="padding-left: 0px"> <input type="text" class="form-control" id="site_accent_color" name="site_accent_color" value="{{ $settings->site_accent_color }}" placeholder="Enter the color code here"></div>
                            </div>
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="mb-3">
                            <label for="site_secondary_color" class="form-label">Site Secondary Color</label>
                            <div class="row">
                                <div class="col-2 col-md-3" style="padding-right: 5px">
                                    <div class="rounded-3" style="width: 100%; height: 100%; background: {{ $settings->site_secondary_color }}"></div>
                                </div>
                                <div class="col-10 col-md-9" style="padding-left: 0px"> <input type="text" class="form-control" id="site_secondary_color" name="site_secondary_color" value="{{ $settings->site_secondary_color }}" placeholder="Enter the color code here"></div>
                            </div>
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="mb-3">
                            <label for="site_secondary_accent_color" class="form-label">Site Secondary Accent Color</label>
                            <div class="row">
                                <div class="col-2 col-md-3" style="padding-right: 5px">
                                    <div class="rounded-3" style="width: 100%; height: 100%; background: {{ $settings->site_secondary_accent_color }}"></div>
                                </div>
                                <div class="col-10 col-md-9" style="padding-left: 0px"> <input type="text" class="form-control" id="site_secondary_accent_color" name="site_secondary_accent_color" value="{{ $settings->site_secondary_accent_color }}" placeholder="Enter the color code here"></div>
                            </div>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="logo_dark" class="form-label">Logo (Dark Verison)</label>
                        <img class="logo-preview" id="logo-dark" src="{{ asset("uploads/logos/$settings->logo_dark") }}" alt="{{ $settings->logo_dark }}">
                        <input type="file" class="form-control" id="logo_dark" name="logo_dark" onchange="document.getElementById('logo-dark').src = window.URL.createObjectURL(this.files[0])" accept="image/png">
                        <div class="error"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="logo_light" class="form-label">Logo (Light Verison)</label>
                        <img class="logo-preview" id="logo-light" style="background: #0007" src="{{ asset("uploads/logos/$settings->logo_light") }}" alt="{{ $settings->logo_light }}">
                        <input type="file" class="form-control" id="logo_light" name="logo_light" onchange="document.getElementById('logo-light').src = window.URL.createObjectURL(this.files[0])" accept="image/png">
                        <div class="error"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="favicon" class="form-label">Favicon</label>
                        <img class="favicon-preview" id="favicon-img" src="{{ asset("uploads/logos/$settings->favicon") }}" alt="{{ $settings->favicon }}">
                        <input type="file" class="form-control" id="favicon" name="favicon" onchange="document.getElementById('favicon-img').src = window.URL.createObjectURL(this.files[0])" accept="image/png">
                        <div class="error"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .logo-preview {
            display: block;
            padding: 10px 15px;
            margin-bottom: 5px;
            width: 150px;
            height: 85px;
            object-fit: contain;
        }

        .favicon-preview {
            display: block;
            padding: 15px;
            width: 85px;
            height: 85px;
            object-fit: cover;
        }

        form .error {
            font-size: .9em;
            color: #dc3545;
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        $('#settings').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('dashboard.settings.update') }}",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('.error').html('');
                    $('input').removeClass('is-invalid');
                    $('select').removeClass('is-invalid');
                    if (response.success) {
                        window.location.reload(true);
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        let field = '#' + key;
                        $(field).addClass('is-invalid');
                        $(field).siblings('.error').html(value);
                        $(field).siblings('.error').css('display', 'block');
                    });
                }
            });
        });
    </script>
@endpush
