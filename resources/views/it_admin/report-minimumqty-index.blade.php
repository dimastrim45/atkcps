@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Minimum Qty Report') }}</h1>
                </div>
                <div class="col-sm-6 float-right text-right">
                    <div class=" pr-3 ">
                        {{-- <a href="{{ route('itemlist-report.print-pdf') }}" target="_blank"><button type="button"
                                class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                <i class="bi bi-printer pr-1"></i>
                                Print
                            </button></a> --}}
                        <a href="{{ route('minimumqty-report.export-excel') }}" target="_blank">
                            <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                autocomplete="off">
                                <i class="bi bi-printer pr-1"></i>
                                Export Excel
                            </button>
                        </a>
                    </div>
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
                                        <th>Min. Qty</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->itemgroup->code }}</td>
                                            <td>{{ $item->uom }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->expdate }}</td>
                                            <td>{{ $item->min_qty }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->status }}</td>
                                        </tr>
                                    @endforeach
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
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: '{{ route('item.search') }}', // Replace with your search route
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        // Update the search results div with the received data
                        $('#search-results').html(data);
                    }
                });
            });
        });
    </script>
@endsection
