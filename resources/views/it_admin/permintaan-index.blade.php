@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('List Permintaan') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-2">
                        <form action="{{ route('permintaan.search') }}" method="GET" class="w-50">
                            @csrf <!-- Add CSRF token field -->
                            <div class="col input-group w-50">
                                <input type="text" name="query" id="search" class="form-control"
                                    placeholder="Search for permintaan ...">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col float-right w-50 text-right">
                            <div class=" pr-3">
                                <a href="{{ route('permintaanadd') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                        autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Permintaan
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
                                        <th>Request Number</th>
                                        <th>Requester</th>
                                        <th>Request Date</th>
                                        <th>Due Date</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        @if (auth()->user()->license !== 'staff')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="permintaan-table-body">
                                    <!-- Table rows will be dynamically added here -->
                                    <!-- Check if the search query is empty -->
                                    @if (request()->query('query') == '')
                                        @foreach ($permintaans as $permintaan)
                                            <!-- Render table rows for all permintaans -->
                                            @include('it_admin.permintaan-row', [
                                                'permintaan' => $permintaan,
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
                                {{ $permintaans->links() }}
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

                // Reference to the permintaan table body
                var $permintaanTableBody = $('#permintaan-table-body');

                // Function to perform the search and update the table
                function performSearch(query) {
                    $.ajax({
                        url: "{{ route('permintaan.search') }}",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            // Replace the table body with the updated data
                            $permintaanTableBody.html(data);
                        }
                    });
                }

                // Event handler for keyup
                $searchInput.on('keyup', function() {
                    var query = $(this).val();

                    if (query.length >= 3) {
                        performSearch(query);
                    } else if (query.length === 0) {
                        // If the search input is empty, show all permintaans
                        performSearch('');
                    } else {
                        // Clear the table if the search input is less than 3 characters
                        $permintaanTableBody.empty();
                    }
                });
            });
        </script>

    </div>
    <!-- /.content -->
@endsection
