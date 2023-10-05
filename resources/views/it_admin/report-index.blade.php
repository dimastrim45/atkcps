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
                            <div class="card btn btn-light btn-block"
                                onclick="window.location.href='{{ route('userlist-report') }}';">
                                <div class="card-body text-left">
                                    <h5 class="card-title">List User</h5>
                                    <p class="card-text">Show all list of user</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block" aria-pressed="false" autocomplete="off"
                                data-toggle="modal" data-target="#BMByDateModal">
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
                            <div class="card btn btn-light btn-block"
                                onclick="window.location.href='{{ route('itemlist-report') }}';">
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
            <!-- Modal -->
            <div class="modal fade" id="BMByDateModal" tabindex="-1" role="dialog" aria-labelledby="BMByDateModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="BMByDateModalLabel">Input Date Range
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('bm-bydate-report') }}" method="GET">
                            @csrf
                            <div class="modal-body" class="">
                                <div class="form-group">
                                    <label for="fromDate">From Date</label>
                                    <input type="date" class="form-control" id="fromDate"
                                        name="fromDate">
                                </div>
                                <div class="form-group">
                                    <label for="toDate">To Date</label>
                                    <input type="date" class="form-control" id="toDate"
                                        name="toDate">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
@endsection
