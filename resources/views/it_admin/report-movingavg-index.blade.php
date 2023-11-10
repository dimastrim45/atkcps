@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Moving Average Report') }}</h1>
                </div>
                <div class="col-sm-6 float-right text-right">
                    <div class=" pr-3 ">
                        {{-- <a href="{{ route('itemlist-report.print-pdf') }}" target="_blank"><button type="button"
                                class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                <i class="bi bi-printer pr-1"></i>
                                Print
                            </button></a> --}}
                        <a href="{{ route('movingavg-report.export-excel') }}" target="_blank">
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
                                        <th>Qty In</th>
                                        <th>Total In</th>
                                        <th>Doctype In</th>
                                        <th>Docnum In</th>
                                        <th>Qty Out</th>
                                        <th>Total Out</th>
                                        <th>Doctype Out</th>
                                        <th>Docnum Out</th>
                                        <th>Qty Saldo</th>
                                        <th>Total Saldo</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movingavgs as $movingavg)
                                        <tr class="text-center">
                                            <td>{{ $movingavg->item->name }}</td>
                                            <td>{{ $movingavg->qtyIn }}</td>
                                            <td>{{ number_format($movingavg->totalIn, 2, '.', ',') }}</td>
                                            <td>{{ $movingavg->DocTypeIn }}</td>
                                            <td>{{ $movingavg->DocNumIn }}</td>
                                            <td>{{ $movingavg->qtyOut }}</td>
                                            <td>{{ number_format($movingavg->totalOut, 2, '.', ',') }}</td>
                                            <td>{{ $movingavg->DocTypeOut }}</td>
                                            <td>{{ $movingavg->DocNumOut }}</td>
                                            <td>{{ $movingavg->qtySaldo }}</td>
                                            <td>{{ number_format($movingavg->totalSaldo, 2, '.', ',') }}</td>
                                            <td>{{ $movingavg->docdate }}</td>
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
