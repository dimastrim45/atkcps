@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Item Groups Management') }}</h1>
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

                        </div>
                        <div class="col float-right w-50 text-right">
                            <div class=" pr-3 ">
                                <a href="{{ route('itemgrpadd') }}"><button type="button" class="btn btn-primary"
                                        data-toggle="button" aria-pressed="false" autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Item Group
                                    </button></a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Group Code</th>
                                        <th>Group Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($users as $user) --}}
                                    <tr class="text-center">
                                        <td>{{ 'ATK' }}</td>
                                        <td>{{ 'Alat Tulis Kantor' }}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                {{-- <button type="button" class="btn btn-danger">Inactive</button> --}}
                                                <button type="button" class="btn btn-warning">Edit</button>
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
