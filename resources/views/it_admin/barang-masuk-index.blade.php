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
                        <form action="{{ route('barangmasuk.search') }}" method="GET" class="w-50">
                            @csrf <!-- Add CSRF token field -->
                            <div class="col input-group w-50">
                                <input type="text" name="query" id="search" class="form-control"
                                    placeholder="Search for barang masuk ...">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        {{-- <button id="searchButton">Search "gil"</button> --}}
                        <div class="col float-right w-50 text-right">
                            <div class=" pr-3">
                                <a href="{{ route('barangmasukadd') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                        autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Item
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
                                        <th>Nomor Barang Masuk</th>
                                        <th>Admin</th>
                                        <th>Nomor PO</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="barangmasuk-table-body">
                                    <!-- Table rows will be dynamically added here -->
                                    <!-- Check if the search query is empty -->
                                    @if (request()->query('query') == '')
                                        @foreach ($barangmasuks as $barangmasuk)
                                            <!-- Render table rows for all barangmasuks -->
                                            @include('it_admin.barang-masuk-row', [
                                                'barangmasuk' => $barangmasuk,
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
                                {{ $barangmasuks->links() }}
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

                // Reference to the barangmasuk table body
                var $barangmasukTableBody = $('#barangmasuk-table-body');

                // Function to perform the search and update the table
                function performSearch(query) {
                    $.ajax({
                        url: "{{ route('barangmasuk.search') }}",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            // Replace the table body with the updated data
                            $barangmasukTableBody.html(data);
                        }
                    });
                }

                // Event handler for keyup
                $searchInput.on('keyup', function() {
                    var query = $(this).val();

                    if (query.length >= 3) {
                        performSearch(query);
                    } else if (query.length === 0) {
                        // If the search input is empty, show all barangmasuks
                        performSearch('');
                    } else {
                        // Clear the table if the search input is less than 3 characters
                        $barangmasukTableBody.empty();
                    }
                });
            });
        </script>

        {{-- <script>
            document.getElementById("searchButton").addEventListener("click", function(
            event) { // Include 'event' as a parameter
                var query = "gil"; // Set the query value to "gil"

                // Send the query to your Laravel controller using AJAX
                $.ajax({
                    type: 'GET', // You can change this to 'POST' if needed
                    url: "{{ route('barangmasuk.search') }}", // Replace with your actual search route
                    data: {
                        query: query
                    }, // Send the query as a parameter
                    success: function(data) {
                        // Handle the response here (e.g., update your page with the results)
                    },
                    error: function() {
                        // Handle errors if necessary
                    }
                });
            });
        </script> --}}

    </div>
    <!-- /.content -->
@endsection
