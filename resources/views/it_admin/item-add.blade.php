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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ route('itemadd.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <label for="">Item Name</label>
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

                                <label for="">Unit of Measurement</label>
                                <div class="input-group mb-4">
                                    <select type="text" name="uom"
                                        class="form-control @error('uom') is-invalid @enderror"
                                        placeholder="{{ __('UoM') }}" required>
                                        <option value="PCS">PCS</option>
                                        <option value="KG">Kilogram</option>
                                        <option value="G">Gram</option>
                                        <option value="DZ">Dozen</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('uom')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">Price</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="{{ __('Price') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('price')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">Expired Date</label>
                                <div class="input-group mb-4">
                                    <input type="date" name="expdate"
                                        class="form-control @error('expdate') is-invalid @enderror"
                                        placeholder="{{ __('Expdate') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('expdate')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">Item Group</label>
                                <div class="input-group mb-4">
                                    <select type="text" name="itemgroup_id"
                                        class="form-control @error('itemgroup_id') is-invalid @enderror"
                                        placeholder="{{ __('Itemgroup') }}" required>
                                        @foreach ($itemgroups as $itemgroup)
                                            <option value="{{ $itemgroup->id }}">{{ $itemgroup->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('itemgroup_id')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">Status</label>
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
                                </div>


                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                <a href="{{ route('items') }}"><button type="button"
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
