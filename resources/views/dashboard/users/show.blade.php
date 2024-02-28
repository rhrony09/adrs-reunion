@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">USER INFORMATION</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.users.update.info') }}" method="POST" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') ?? $user->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') ?? $user->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Mobile</label>
                                    <input type="tel" name="mobile" class="form-control  {{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile') ?? $user->mobile }}">
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Batch</label>
                                    @if (auth()->user()->role_id == 1 && $user->role_id != 1)
                                        <select class="form-select {{ $errors->has('batch') ? 'is-invalid' : '' }}" name="batch_id">
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id || $user->batch_id == $batch->id ? 'selected' : '' }}>{{ $batch->batch }}</option>
                                            @endforeach
                                        </select>
                                        @error('batch')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <select class="form-select" disabled>
                                            <option value="" selected>{{ $user->batch ? $user->batch->batch : '--' }}</option>
                                        </select>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Role</label>
                                    @if (auth()->user()->role_id == 1 && $user->role_id != 1)
                                        <select class="form-select" name="role_id">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id || $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select class="form-select" disabled>
                                            <option value="1" selected>{{ $user->role->name }}</option>
                                        </select>
                                    @endif
                                </div>
                                <div class="text-start">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--change password-->
            <div class="card shadow-none border">
                <div class="card-header">
                    <h6 class="mb-0">Change Password</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.users.update.password') }}" method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Enter new password" value="{{ old('password') }}" required>
                                <span class="input-group-text" id="password-show"><i class="fa-solid fa-eye"></i></span>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control  @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Enter confirm password" value="{{ old('confirm_password') }}" required>
                                <span class="input-group-text" id="confirm_password-show"><i class="fa-solid fa-eye"></i></span>
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="text-center">
                        <img id="profile-pic" src="{{ $user->profile_picture }}" class="profile-avatar shadow" width="120" height="120" alt="{{ $user->name }}">
                    </div>
                    <div class="text-center mt-4">
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="mb-0 text-secondary">{{ $user->role->name }}</p>
                        <p class="mb-0 text-secondary">Username: {{ $user->username ? $user->username : 'N/A' }}</p>
                        <p class="mb-0 text-secondary">Mobile No: {{ $user->mobile }}</p>
                        <p class="mb-0 text-secondary">Email: {{ $user->email }}</p>
                        <div class="mt-4"></div>
                    </div>
                    <div class="mt-5">
                        <form action="{{ route('dashboard.users.update.pro.pic') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Picture <small>(Supported JPG & PNG)</small></label>
                                <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" onchange="document.getElementById('profile-pic').src = window.URL.createObjectURL(this.files[0])" accept="image/jpeg, image/png">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#password-show').click(function() {
                if ($('#password').attr('type') == 'password') {
                    $('#password').attr('type', 'text');
                    $('#password-show i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $('#password').attr('type', 'password');
                    $('#password-show i').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
            $('#confirm_password-show').click(function() {
                if ($('#confirm_password').attr('type') == 'password') {
                    $('#confirm_password').attr('type', 'text');
                    $('#confirm_password-show i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $('#confirm_password').attr('type', 'password');
                    $('#confirm_password-show i').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
@endpush
