@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Item Master Data') }}</h1>
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
                        <form action="{{ route('item.search') }}" method="GET" class="w-50">
                            @csrf <!-- Add CSRF token field -->
                            <div class="col input-group w-50">
                                <input type="text" name="query" id="search" class="form-control"
                                    placeholder="Search for item ...">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        {{-- @foreach ($items as $item)
                            <!-- Display each live search result here -->
                            <div>{{ $item->name }}</div>
                        @endforeach --}}

                        <div class="col float-right w-50 text-right">
                            <div class=" pr-3 ">
                                <a href="{{ route('itemadd') }}"><button type="button" class="btn btn-primary"
                                        data-toggle="button" aria-pressed="false" autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Item
                                    </button></a>
                                <a href="{{ route('itemgroups.index') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                        autocomplete="off">
                                        <i class="bi bi-stack pr-1"></i>
                                        Item Group Management
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
                                        <th>Item Name</th>
                                        <th>Item Group</th>
                                        <th>UoM</th>
                                        <th>Price</th>
                                        <th>Expired Date</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item-table-body">
                                    <!-- Table rows will be dynamically added here -->
                                    <!-- Check if the search query is empty -->
                                    @if (request()->query('query') == '')
                                        @foreach ($items as $item)
                                            <!-- Render table rows for all items -->
                                            @include('it_admin.item-row', ['item' => $item])
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
                                {{ $items->links() }}
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

                // Reference to the item table body
                var $itemTableBody = $('#item-table-body');

                // Function to perform the search and update the table
                function performSearch(query) {
                    $.ajax({
                        url: "{{ route('item.search') }}",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            // Replace the table body with the updated data
                            $itemTableBody.html(data);
                        }
                    });
                }

                // Event handler for keyup
                $searchInput.on('keyup', function() {
                    var query = $(this).val();

                    if (query.length >= 3) {
                        performSearch(query);
                    } else if (query.length === 0) {
                        // If the search input is empty, show all items
                        performSearch('');
                    } else {
                        // Clear the table if the search input is less than 3 characters
                        $itemTableBody.empty();
                    }
                });
            });
        </script>
    </div>
    <!-- /.content -->
@endsection
