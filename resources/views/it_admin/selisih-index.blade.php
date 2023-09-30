@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Selisih Stock') }}</h1>
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
                                <a href="{{ route('selisih.add') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                    autocomplete="off">
                                    <i class="bi bi-plus-lg pr-1"></i>
                                    Tambah Document
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
                                        <th>Document Number</th>
                                        <th>Document Date</th>
                                        <th>Admin</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($users as $user) --}}
                                    <tr class="text-center">
                                        <td>{{ '202308010001' }}</td>
                                        <td>{{ '10-08-2023' }}</td>
                                        <td>{{ 'Rois' }}</td>
                                        <td>{{ 'Stockan Agustus' }}</td>
                                        <td>{{ 'Approved' }}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-danger">Reject</button>
                                                <button type="button" class="btn btn-warning">Edit</button>
                                                <button type="button" class="btn btn-success">Approve</button>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

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
