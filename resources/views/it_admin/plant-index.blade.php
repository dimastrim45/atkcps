@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Plant Management') }}</h1>
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
                    <div class="row mb-2">
                        <div class="col input-group w-50">
                            <input type="text" class="form-control" placeholder="Search for item ...">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col float-right w-50 text-right">
                            <div class=" pr-3">
                                <a href="{{ route('plant.create') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                        autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Plant
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Code Plant</th>
                                        <th>Plant Name</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Address</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plants as $plant)
                                    <tr class="text-center">
                                        <td>{{ $plant->code }}</td>
                                        <td>{{ $plant->name }}</td>
                                        <td>{{ $plant->city }}</td>
                                        <td>{{ $plant->province }}</td>
                                        <td>{{ $plant->address }}</td>
                                        {{-- <td>{{ $plant->status }}</td> --}}
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                {{-- <button type="button" class="btn btn-danger">Inactive</button> --}}
                                                <a href="{{ route('plant.edit', ['plant' => $plant->id]) }}"><button type="button" class="btn btn-warning">Edit</button></a>
                                                <button type="button" class="btn btn-danger">Remove</button>
                                                {{-- <button type="button" class="btn btn-success">Active</button> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                {{ $plants->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
