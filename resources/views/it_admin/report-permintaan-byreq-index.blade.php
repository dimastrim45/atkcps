@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('List Permintaan By Requester ') . $requester->name }}</h1>
                </div>
                <div class="col-sm-6 float-right text-right">
                    <div class="pl-3">
                        <form method="GET" action="{{ route('permintaan-byreq-report.print-pdf') }}" target="_blank" class="d-inline">
                            <input type="hidden" name="requester_id" value="{{ $requester->id }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-printer pr-1"></i> Print
                            </button>
                        </form>
                        <form method="GET" action="{{ route('permintaan-byreq-report.export-excel') }}" target="_blank"
                            class="d-inline">
                            <input type="hidden" name="requester_id" value="{{ $requester->id }}">
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
                                        <th>Request Number</th>
                                        <th>Requester</th>
                                        <th>Doc. Date</th>
                                        <th>Due Date</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Open Qty</th>
                                        <th>Exp Date</th>
                                        <th>Price</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($permintaans as $permintaan)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $permintaan->docnum }}</td>
                                            <td>{{ $permintaan->user->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permintaan->docdate)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permintaan->duedate)) }}</td>
                                            <td>{{ $permintaan->item->name }}</td>
                                            <td>{{ $permintaan->qty }}</td>
                                            <td>{{ $permintaan->openqty }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permintaan->expdate)) }}</td>
                                            <td>{{ number_format($permintaan->price, 2, '.', ',') }}</td>
                                            <td class="word-wrap: break-word w-25">
                                                {{ $permintaan->remarks }}
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
