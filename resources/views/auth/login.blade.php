@extends('layouts.auth')
@section('content')
    <div class="card shadow rounded-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                <img src="assets/images/error/login-img.jpg" class="img-fluid" alt="">
                <img src="{{ asset('assets/backend/images/error/login-img.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Sign In</h5>
                    <p class="card-text mb-2">Please login to access the dashboard!</p>
                    <form class="form-body" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-separater text-center mb-4"> <span>SIGN IN WITH MOBILE NUMBER</span>
                            <hr>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Mobile Number/Email</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                    <input type="text" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" id="inputEmailAddress" name="email" placeholder="Enter Mobile Number or Email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Password</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                    <input type="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" id="inputChoosePassword" name="password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
