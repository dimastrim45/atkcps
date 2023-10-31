@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('User Edit') }} {{ $user->name }}</h1>
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

                        <form action="/user/edit/{{ $user->email }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <div class="input-group">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}"
                                            required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('name')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}"
                                            required>
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
                                            class="form-control @error('password') is-invalid @enderror">
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
                                            placeholder="{{ __('Branch') }}" value="{{ old('plant_id', $user->branch) }}"
                                            required>
                                            @foreach ($plants as $plant)
                                                <option value="{{ $plant->id }}"
                                                    {{ $plant->id == old('plant_id', $user->plant_id) ? 'selected' : '' }}>
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
                                            value="{{ old('department', $user->department) }}" required>
                                            <option value="ENG" {{ $user->department == 'ENG' ? 'selected' : '' }}>
                                                Engineering</option>
                                            <option value="FAT" {{ $user->department == 'FAT' ? 'selected' : '' }}>
                                                Finance Accounting Tax
                                            </option>
                                            <option value="GFG" {{ $user->department == 'GFG' ? 'selected' : '' }}>
                                                Gudang FG</option>
                                            <option value="GRT" {{ $user->department == 'GRT' ? 'selected' : '' }}>
                                                Gudang Retail
                                            </option>
                                            <option value="GRM" {{ $user->department == 'GRM' ? 'selected' : '' }}>
                                                Gudang RM</option>
                                            <option value="HRGA" {{ $user->department == 'HRGA' ? 'selected' : '' }}>
                                                HRGA</option>
                                            <option value="DGSL" {{ $user->department == 'DGSL' ? 'selected' : '' }}>
                                                Digital Sales</option>
                                            <option value="SLS" {{ $user->department == 'SLS' ? 'selected' : '' }}>
                                                Sales</option>
                                            <option value="MRKT" {{ $user->department == 'MRKT' ? 'selected' : '' }}>
                                                Marketing</option>
                                            <option value="DEL" {{ $user->department == 'DEL' ? 'selected' : '' }}>
                                                Pengiriman
                                            </option>
                                            <option value="PROD" {{ $user->department == 'PROD' ? 'selected' : '' }}>
                                                Produksi</option>
                                            <option value="PPIC" {{ $user->department == 'PPIC' ? 'selected' : '' }}>
                                                PPIC
                                            </option>
                                            <option value="RPR" {{ $user->department == 'RPR' ? 'selected' : '' }}>
                                                Repair
                                            </option>
                                            <option value="PRCH" {{ $user->department == 'PRCH' ? 'selected' : '' }}>
                                                Purchasing
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

                                <div class="form-group">
                                    <label for="license">License</label>
                                    <div class="input-group mb-3">
                                        <select type="text" name="license"
                                            class="form-control @error('license') is-invalid @enderror"
                                            placeholder="{{ __('License') }}"
                                            value="{{ old('license', $user->license) }}" required>
                                            <option value="administrator"
                                                {{ $user->license == 'administrator' ? 'selected' : '' }}>Administrator
                                            </option>
                                            <option value="staff" {{ $user->license == 'staff' ? 'selected' : '' }}>
                                                Staff</option>
                                            <option value="hradmin" {{ $user->license == 'hradmin' ? 'selected' : '' }}>
                                                HR Admin</option>
                                            <option value="manager" {{ $user->license == 'manager' ? 'selected' : '' }}>
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
