@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Item Master Data') }}</h1>
                </div>
                <div class="col-sm-6 float-right text-right">
                    <div class=" pr-3 ">
                        <a href="{{ route('itemlist-report.print-pdf') }}" target="_blank"><button type="button"
                                class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                <i class="bi bi-printer pr-1"></i>
                                Print
                            </button></a>
                        <a href="{{ route('itemlist-report.export-excel') }}" target="_blank">
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
                                        <th>UoM</th>
                                        <th>In Stock</th>
                                        <th>Permintaan</th>
                                        <th>Pengeluaran Barang</th>
                                        <th>Available</th>
                                        <th>Item Price Per Uom</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventoryData as $item)
                                        <tr class="text-center">
                                            <td>{{ $item['item_name'] }}</td>
                                            <td>{{ $item['uom'] }}</td>
                                            <td>{{ $item['in_stock'] }}</td>
                                            <td>{{ $item['permintaan'] }}</td>
                                            <td>{{ $item['pengeluaran_barang'] }}</td>
                                            <td>{{ $item['available'] }}</td>
                                            <td>{{ $item['item_price_per_uom'] }}</td>
                                            <td>{{ $item['total'] }}</td>
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
