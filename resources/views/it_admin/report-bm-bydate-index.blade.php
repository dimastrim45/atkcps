@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('List Barang Masuk') }}</h1>
                </div>
                <div class="col-sm-6 float-right text-right">
                    <div class="pl-3">
                        <form method="GET" action="{{ route('bm-bydate-report.print-pdf') }}" target="_blank"
                            class="d-inline">
                            <input type="hidden" name="fromDate" value="{{ $fromDate }}">
                            <input type="hidden" name="toDate" value="{{ $toDate }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-printer pr-1"></i> Print
                            </button>
                        </form>
                        <form method="GET" action="{{ route('bm-bydate-report.export-excel') }}" target="_blank"
                            class="d-inline">
                            <input type="hidden" name="fromDate" value="{{ $fromDate }}">
                            <input type="hidden" name="toDate" value="{{ $toDate }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-printer pr-1"></i> Export
                            </button>
                        </form>
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
                                        <th>No</th>
                                        <th>Nomor Barang Masuk</th>
                                        <th>Doc. Date</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Exp Date</th>
                                        <th>Price</th>
                                        <th>Admin</th>
                                        <th>Nomor PO</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($barangmasuks as $barangmasuk)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $barangmasuk->docnum }}</td>
                                            <td>{{ date('d-m-Y', strtotime($barangmasuk->docdate)) }}</td>
                                            <td>{{ $barangmasuk->item->name }}</td>
                                            <td>{{ $barangmasuk->qty }}</td>
                                            <td>{{ date('d-m-Y', strtotime($barangmasuk->expdate)) }}</td>
                                            <td>{{ number_format($barangmasuk->price, 2, '.', ',') }}</td>
                                            <td>{{ $barangmasuk->admin }}</td>
                                            <td>{{ $barangmasuk->po_docnum }}</td>
                                            <td class="word-wrap: break-word w-25">
                                                {{ $barangmasuk->remarks }}
                                            </td>
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
