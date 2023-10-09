@extends('it_admin.layouts.app')

@section('content')
    {{-- <script>
        $(document).ready(function() {
            @if (session('error'))
                $('#errorModal').modal('show');
            @endif
        });
    </script> --}}
    {{-- @if (session('error'))
        <script>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        </script>
    @endif --}}
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
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
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
                            <div class="card btn btn-light btn-block" aria-pressed="false" autocomplete="off"
                                data-toggle="modal" data-target="#PengeluaranByDateModal">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Pengeluaran By Date</h5>
                                    <p class="card-text">Show all list of user</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block" aria-pressed="false" autocomplete="off"
                                data-toggle="modal" data-target="#PengeluaranByReqModal">
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
                            <div class="card btn btn-light btn-block" aria-pressed="false" autocomplete="off"
                                data-toggle="modal" data-target="#PermintaanByDateModal">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Permintaan By Date</h5>
                                    <p class="card-text">Show all list of item</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block" aria-pressed="false" autocomplete="off"
                                data-toggle="modal" data-target="#PermintaanByReqModal">
                                <div class="card-body text-left">
                                    <h5 class="card-title">Permintaan By Requester</h5>
                                    <p class="card-text">Show all list of item</p>
                                </div>
                            </div>
                            <div class="card btn btn-light btn-block" aria-pressed="false" autocomplete="off"
                                data-toggle="modal" data-target="#SelisihByDateModal">
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
                                    <input type="date" class="form-control" id="fromDate" name="fromDate">
                                </div>
                                <div class="form-group">
                                    <label for="toDate">To Date</label>
                                    <input type="date" class="form-control" id="toDate" name="toDate">
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

            {{-- permintaan by date modal --}}
            <div class="modal fade" id="PermintaanByDateModal" tabindex="-1" role="dialog"
                aria-labelledby="PermintaanByDateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PermintaanByDateModalLabel">Input Date Range
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('permintaan-bydate-report') }}" method="GET">
                            @csrf
                            <div class="modal-body" class="">
                                <div class="form-group">
                                    <label for="fromDate">From Date</label>
                                    <input type="date" class="form-control" id="fromDate" name="fromDate">
                                </div>
                                <div class="form-group">
                                    <label for="toDate">To Date</label>
                                    <input type="date" class="form-control" id="toDate" name="toDate">
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
            {{-- permintaan by Req modal --}}
            <div class="modal fade" id="PermintaanByReqModal" tabindex="-1" role="dialog"
                aria-labelledby="PermintaanByReqModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PermintaanByReqModalLabel">Input Date Range
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('permintaan-byreq-report') }}" method="GET">
                            @csrf
                            <div class="modal-body" class="">
                                <div class="form-group">
                                    <label for="requester">From Date</label>
                                    <select name="requester_id" id="requester_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
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

            {{-- pengeluaran by date modal --}}
            <div class="modal fade" id="PengeluaranByDateModal" tabindex="-1" role="dialog"
                aria-labelledby="PengeluaranByDateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PengeluaranByDateModalLabel">Input Date Range
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('pengeluaran-bydate-report') }}" method="GET">
                            @csrf
                            <div class="modal-body" class="">
                                <div class="form-group">
                                    <label for="fromDate">From Date</label>
                                    <input type="date" class="form-control" id="fromDate" name="fromDate">
                                </div>
                                <div class="form-group">
                                    <label for="toDate">To Date</label>
                                    <input type="date" class="form-control" id="toDate" name="toDate">
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
            {{-- pengeluaran by Req modal --}}
            <div class="modal fade" id="PengeluaranByReqModal" tabindex="-1" role="dialog"
                aria-labelledby="PengeluaranByReqModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PengeluaranByReqModalLabel">Input Date Range
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('pengeluaran-byreq-report') }}" method="GET">
                            @csrf
                            <div class="modal-body" class="">
                                <div class="form-group">
                                    <label for="requester">From Date</label>
                                    <select name="requester_id" id="requester_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
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

            {{-- Selisih by date modal --}}
            <div class="modal fade" id="SelisihByDateModal" tabindex="-1" role="dialog"
                aria-labelledby="SelisihByDateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="SelisihByDateModalLabel">Input Date Range
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('selisih-bydate-report') }}" method="GET">
                            @csrf
                            <div class="modal-body" class="">
                                <div class="form-group">
                                    <label for="fromDate">From Date</label>
                                    <input type="date" class="form-control" id="fromDate" name="fromDate">
                                </div>
                                <div class="form-group">
                                    <label for="toDate">To Date</label>
                                    <input type="date" class="form-control" id="toDate" name="toDate">
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

            {{-- error modal --}}
            <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Error Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Display your error message here -->
                            {{ session('error') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
