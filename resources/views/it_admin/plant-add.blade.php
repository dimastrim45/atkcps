@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Add New Item') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if ($errors->has('code'))
                <div class="alert alert-danger">
                    {{ $errors->first('code') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ route('plant.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <label for="">Plant Name</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ __('Name') }}" required>
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

                                <label for="">Plant Code</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="code"
                                        class="form-control @error('code') is-invalid @enderror"
                                        placeholder="{{ __('Code') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('code')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">City</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="city"
                                        class="form-control @error('city') is-invalid @enderror"
                                        placeholder="{{ __('City') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('city')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">Province</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="province"
                                        class="form-control @error('province') is-invalid @enderror"
                                        placeholder="{{ __('Province') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('province')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">Address</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        placeholder="{{ __('Address') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('address')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- <label for="">Status</label>
                                <div class="input-group mb-4">
                                    <select type="text" name="status"
                                        class="form-control @error('status') is-invalid @enderror"
                                        placeholder="{{ __('Status') }}" required>
                                        <option value="active">ACTIVE</option>
                                        <option value="inactive">INACTIVE</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('status')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div> --}}
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                <a href="{{ url()->previous() }}"><button type="button"
                                        class="btn btn-danger">{{ __('Cancel') }}</button></a>
                            </div>
                        </form>

                        <div class="card-footer clearfix">
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
