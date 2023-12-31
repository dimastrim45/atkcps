@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('My profile') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <div class="input-group">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('Name') }}"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        @error('name')
                                            <span class="error invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="{{ __('Email') }}"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="error invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="{{ __('New password') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="error invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="{{ __('New password confirmation') }}"
                                            autocomplete="new-password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Branch">Branch</label>
                                    <div class="input-group">
                                        <select type="text" name="plant_id"
                                            class="form-control @error('plant_id') is-invalid @enderror"
                                            placeholder="{{ __('Branch') }}"
                                            value="{{ old('plant_id', auth()->user()->plant_id) }}" required>
                                            @foreach ($plants as $plant)
                                                <option value="{{ $plant->id }}"
                                                    {{ $plant->id == old('plant_id', auth()->user()->plant_id) ? 'selected' : '' }}>
                                                    {{ $plant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-solid fa-building"></span>
                                            </div>
                                        </div>
                                        @error('plant_id')
                                            <span class="error invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <div class="input-group">
                                        <select type="text" name="department"
                                            class="form-control @error('department') is-invalid @enderror"
                                            placeholder="{{ __('Department') }}"
                                            value="{{ old('department', auth()->user()->department) }}" required>
                                            <option value="DEL"
                                                {{ auth()->user()->department == 'DEL' ? 'selected' : '' }}>
                                                Delivery</option>
                                            <option value="DIST"
                                                {{ auth()->user()->department == 'DIST' ? 'selected' : '' }}>Distribution
                                            </option>
                                            <option value="FAT"
                                                {{ auth()->user()->department == 'FAT' ? 'selected' : '' }}>
                                                Finance Accounting Tax</option>
                                            <option value="HRGA"
                                                {{ auth()->user()->department == 'HRGA' ? 'selected' : '' }}>HRGA</option>
                                            <option value="MGM"
                                                {{ auth()->user()->department == 'MGM' ? 'selected' : '' }}>
                                                Management</option>
                                            <option value="MKT"
                                                {{ auth()->user()->department == 'MKT' ? 'selected' : '' }}>
                                                Marketing</option>
                                            <option value="PPI"
                                                {{ auth()->user()->department == 'PPI' ? 'selected' : '' }}>
                                                PPIC</option>
                                            <option value="PRO"
                                                {{ auth()->user()->department == 'PRO' ? 'selected' : '' }}>
                                                Production</option>
                                            <option value="PUR"
                                                {{ auth()->user()->department == 'PUR' ? 'selected' : '' }}>
                                                Purchasing</option>
                                            <option value="RETAIL"
                                                {{ auth()->user()->department == 'RETAIL' ? 'selected' : '' }}>Retail
                                            </option>
                                            <option value="WHS"
                                                {{ auth()->user()->department == 'WHS' ? 'selected' : '' }}>
                                                Warehouse</option>
                                            <option value="WHSALE"
                                                {{ auth()->user()->department == 'WHSALE' ? 'selected' : '' }}>Wholesale
                                            </option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas bi bi-people-fill"></span>
                                            </div>
                                        </div>
                                        @error('department')
                                            <span class="error invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                @if (auth()->user()->license == 'administrator')
                                    <div class="form-group">
                                        <label for="license">License</label>
                                        <div class="input-group mb-3">
                                            <select type="text" name="license"
                                                class="form-control @error('license') is-invalid @enderror"
                                                placeholder="{{ __('License') }}"
                                                value="{{ old('license', auth()->user()->license) }}" required>
                                                <option value="administrator"
                                                    {{ auth()->user()->license == 'administrator' ? 'selected' : '' }}>
                                                    Administrator
                                                </option>
                                                <option value="staff"
                                                    {{ auth()->user()->license == 'staff' ? 'selected' : '' }}>
                                                    Staff</option>
                                                <option value="hradmin"
                                                    {{ auth()->user()->license == 'hradmin' ? 'selected' : '' }}>
                                                    HR Admin</option>
                                                <option value="manager"
                                                    {{ auth()->user()->license == 'manager' ? 'selected' : '' }}>
                                                    Manager</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-solid fa-id-card"></span>
                                                </div>
                                            </div>
                                            @error('license')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
    @if ($message = Session::get('success'))
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr.success('{{ $message }}')
        </script>
    @endif
@endsection
