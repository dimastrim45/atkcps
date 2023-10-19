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

                        @if (in_array(auth()->user()->license, ['administrator', 'hradmin', 'manager']))
                            <div class="col float-right w-50 text-right">
                                <div class=" pr-3 ">
                                    <a href="{{ route('itemadd') }}"><button type="button" class="btn btn-primary"
                                            data-toggle="button" aria-pressed="false" autocomplete="off">
                                            <i class="bi bi-plus-lg pr-1"></i>
                                            Tambah Item
                                        </button></a>
                                    <a href="{{ route('itemgroups.index') }}">
                                        <button type="button" class="btn btn-primary" data-toggle="button"
                                            aria-pressed="false" autocomplete="off">
                                            <i class="bi bi-stack pr-1"></i>
                                            Item Group Management
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th onclick="sortTable(0)">Item Name</th>
                                        <th onclick="sortTable(1)">Item Group</th>
                                        <th onclick="sortTable(2)">UoM</th>
                                        <th onclick="sortTable(3)">Price</th>
                                        <th onclick="sortTable(4)">Expired Date</th>
                                        <th onclick="sortTable(5)">Qty</th>
                                        <th onclick="sortTable(6)">Min. Qty</th>
                                        <th onclick="sortTable(7)">Status</th>
                                        @if (in_array(auth()->user()->license, ['administrator', 'hradmin']))
                                            <th>Action</th>
                                        @endif
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

        {{-- below is script to sort a small table
        doesn't have impact on pagination
        server side sorting required --}}
        {{-- <script>
            function sortTable(n) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                table = document.getElementById("myTable");
                switching = true;
                //Set the sorting direction to ascending:
                dir = "asc";
                /*Make a loop that will continue until
                no switching has been done:*/
                while (switching) {
                    //start by saying: no switching is done:
                    switching = false;
                    rows = table.rows;
                    /*Loop through all table rows (except the
                    first, which contains table headers):*/
                    for (i = 1; i < (rows.length - 1); i++) {
                        //start by saying there should be no switching:
                        shouldSwitch = false;
                        /*Get the two elements you want to compare,
                        one from current row and one from the next:*/
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];
                        /*check if the two rows should switch place,
                        based on the direction, asc or desc:*/
                        if (dir == "asc") {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                //if so, mark as a switch and break the loop:
                                shouldSwitch = true;
                                break;
                            }
                        } else if (dir == "desc") {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                //if so, mark as a switch and break the loop:
                                shouldSwitch = true;
                                break;
                            }
                        }
                    }
                    if (shouldSwitch) {
                        /*If a switch has been marked, make the switch
                        and mark that a switch has been done:*/
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        //Each time a switch is done, increase this count by 1:
                        switchcount++;
                    } else {
                        /*If no switching has been done AND the direction is "asc",
                        set the direction to "desc" and run the while loop again.*/
                        if (switchcount == 0 && dir == "asc") {
                            dir = "desc";
                            switching = true;
                        }
                    }
                }
            }
        </script> --}}
    </div>
    <!-- /.content -->
@endsection
