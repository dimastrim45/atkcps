@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('List Pengeluaran Barang') }}</h1>
                </div>
                <div class="col-sm-6 float-right text-right">
                    <div class=" pr-3 ">
                        <form method="GET" action="{{ route('pengeluaran-bydate-report.print-pdf') }}" target="_blank">
                            <input type="hidden" name="fromDate" value="{{ $fromDate }}">
                            <input type="hidden" name="toDate" value="{{ $toDate }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-printer pr-1"></i> Print
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
                                        <th>Nomor Pengeluaran</th>
                                        <th>Status</th>
                                        <th>Admin</th>
                                        <th>Requester</th>
                                        <th>Branch</th>
                                        <th>Doc. Date</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Exp Date</th>
                                        <th>Price</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($pengeluarans as $pengeluaran)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $pengeluaran->docnum }}</td>
                                            <td>{{ $pengeluaran->status }}</td>
                                            <td>{{ $pengeluaran->admin }}</td>
                                            <td>{{ $pengeluaran->requester_name }}</td>
                                            <td>{{ $pengeluaran->requester->plant->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($pengeluaran->docdate)) }}</td>
                                            <td>{{ $pengeluaran->item->name }}</td>
                                            <td>{{ $pengeluaran->qty }}</td>
                                            <td>{{ date('d-m-Y', strtotime($pengeluaran->expdate)) }}</td>
                                            <td>{{ $pengeluaran->price }}</td>
                                            <td class="word-wrap: break-word w-25">
                                                {{ $pengeluaran->remarks }}
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
@endsection
