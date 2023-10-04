@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Reports') }}</h1>
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
                    {{-- the body --}}
                    <div class="row p-0">
                        <div class="col-sm-6">
                            <div class="card btn btn-light btn-block">
                                <div class="card-body text-left">
                                    <h5 class="card-title">List User</h5>
                                    <p class="card-text">Show all list of user</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Barang Masuk By Date</h5>
                                    <p class="card-text">Show all list of user</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Pengeluaran By Date</h5>
                                    <p class="card-text">Show all list of user</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Pengeluaran By Requester</h5>
                                    <p class="card-text">Show all list of user</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card btn btn-light btn-block" onclick="window.location.href='{{ route('itemlist-report') }}';">
                                <div class="card-body text-left">
                                    <h5 class="card-title">List Item Master Data</h5>
                                    <p class="card-text">Show all list of item</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Permintaan By Date</h5>
                                    <p class="card-text">Show all list of item</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Permintaan By Requester</h5>
                                    <p class="card-text">Show all list of item</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Selisih Stock By Date</h5>
                                    <p class="card-text">Show all list of item</p>
                                </div>
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
