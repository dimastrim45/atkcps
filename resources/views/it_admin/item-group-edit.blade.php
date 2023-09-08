@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Item Group Edit') }} {{ $itemgroup->name }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="itemgroups/edit/{{ $itemgroup->code }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="card-body">
                                <label for="">Group Code</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="code"
                                        class="form-control @error('code') is-invalid @enderror"
                                        placeholder="{{ __('Code') }}" value="{{ old('code', $itemgroup->code) }}"
                                        required>
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

                                <label for="">Group Name</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ __('Name') }}" value="{{ old('name', $itemgroup->name) }}"
                                        required>
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

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                <a href="{{ route('itemgroups.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
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
