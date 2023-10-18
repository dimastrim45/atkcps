@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Pengeluaran Barang') }}</h1>
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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close bg-white rounded" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-2">
                        <form action="{{ route('pengeluaran.search') }}" method="GET" class="w-50">
                            @csrf <!-- Add CSRF token field -->
                            <div class="col input-group w-50">
                                <input type="text" name="query" id="search" class="form-control"
                                    placeholder="Search for pengeluaran ...">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if (in_array(auth()->user()->license, ['administrator', 'hradmin']))
                            <div class="col float-right w-50 text-right">
                                <div class=" pr-3">
                                    <button type="button" class="btn btn-primary" aria-pressed="false" autocomplete="off"
                                        data-toggle="modal" data-target="#exampleModal">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Pengeluaran Barang
                                    </button>
                                </div>
                            </div>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran Barang
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('pengeluaranadd') }}" method="GET">
                                        @csrf
                                        <div class="modal-body" class="">
                                            <div class="form-group">
                                                <label for="permintaan_docnum">Nomor Permintaan</label>
                                                <input type="text" class="form-control" id="permintaan_docnum"
                                                    name="permintaan_docnum">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nomor Pengeluaran</th>
                                        <th>Admin</th>
                                        <th>Requester</th>
                                        <th>Document Date</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        @if (auth()->user()->license !== 'staff')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="pengeluaran-table-body">
                                    <!-- Table rows will be dynamically added here -->
                                    <!-- Check if the search query is empty -->
                                    @if (request()->query('query') == '')
                                        @foreach ($pengeluarans as $pengeluaran)
                                            <!-- Render table rows for all barangmasuks -->
                                            @include('it_admin.pengeluaran-row', [
                                                'pengeluaran' => $pengeluaran,
                                            ])
                                        @endforeach
                                    @else
                                        <!-- Render search results using AJAX -->
                                        <!-- Table rows will be dynamically added here -->
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                {{ $pengeluarans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Reference to the search input field
                var $searchInput = $('#search');

                // Reference to the pengeluaran table body
                var $pengeluaranTableBody = $('#pengeluaran-table-body');

                // Function to perform the search and update the table
                function performSearch(query) {
                    $.ajax({
                        url: "{{ route('pengeluaran.search') }}",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            // Replace the table body with the updated data
                            $pengeluaranTableBody.html(data);
                        }
                    });
                }

                // Event handler for keyup
                $searchInput.on('keyup', function() {
                    var query = $(this).val();

                    if (query.length >= 3) {
                        performSearch(query);
                    } else if (query.length === 0) {
                        // If the search input is empty, show all pengeluarans
                        performSearch('');
                    } else {
                        // Clear the table if the search input is less than 3 characters
                        $pengeluaranTableBody.empty();
                    }
                });
            });
        </script>
    </div>
    <!-- /.content -->
@endsection
