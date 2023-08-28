@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Barang Masuk') }}</h1>
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
                                <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                    autocomplete="off">
                                    <i class="bi bi-plus-lg pr-1"></i>
                                    Tambah Item
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nomor Barang Masuk</th>
                                        <th>Admin</th>
                                        <th>Nomor PO</th>
                                        <th>Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($users as $user) --}}
                                    <tr class="text-center">
                                        <td>{{ '20230817001' }}</td>
                                        <td>{{ 'Izza' }}</td>
                                        <td>{{ '20230817025' }}</td>
                                        <td>{{ '05-08-2023' }}</td>
                                        <td class="word-wrap: break-word w-25">
                                            {{ 'Stock Tinta bulan Januari aaaaaaaaa aaaaa aaaaaa aaaaaaa aaaaaa aaaaaa aaaa aaaaa aaaaa aaaaaa aaaaaaaaa aaaaaaaaaaaa aa aaaaaaaaa aaaaaaaa aaaa aaaaaaa aaaaa' }}
                                        </td>
                                    </tr>
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
