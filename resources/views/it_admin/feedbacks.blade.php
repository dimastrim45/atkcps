@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Feedback') }}</h1>
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
                            {{-- <div class=" pr-3">
                                <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                    autocomplete="off">
                                    <i class="bi bi-plus-lg pr-1"></i>
                                    Tambah Item
                                </button>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Feedback Number</th>
                                        <th>User Name</th>
                                        <th>Date</th>
                                        <th>Branch</th>
                                        <th>Telp. Number</th>
                                        <th>Request Doc. Num</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($users as $user) --}}
                                    <tr class="text-center">
                                        <th>{{ '1' }}</th>
                                        <td>{{ 'Toni' }}</td>
                                        <td>{{ '10-08-2023' }}</td>
                                        <td>{{ 'FAT' }}</td>
                                        <td><a href="https://wa.me/085155058869" target="_blank">{{ '085155058869' }}</a></td>
                                        <td>{{ '20230801001' }}</td>
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
