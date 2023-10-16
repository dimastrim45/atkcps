@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Pengeluaran - ') . $pengeluarans->first()->docnum }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <h1>{{ __('Status - ') . $pengeluarans->first()->status }}</h1>
                </div>
            </div>
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
                            <div class="row pl-2 m-2 d-flex justify-content-between">
                                {{-- add admin and status --}}
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Doc Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" value="{{ $docDate }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Permintaan Doc.Number</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                value="{{ $pengeluarans->first()->permintaan->docnum }}" disabled>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Admin</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"
                                                value="{{ $pengeluarans->first()->admin }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Requester</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"
                                                value="{{ $pengeluarans->first()->requester_name }}" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table class="table" id="thetable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item Name</th>
                                        <th>Qty</th>
                                        <th>UoM</th>
                                        <th>Price</th>
                                        <th>Expired Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengeluarans as $pengeluaran)
                                        <tr class="text-center">
                                            <td class=" w-25">
                                                {{ $pengeluaran->item->name }}
                                            </td>
                                            <td>
                                                {{ $pengeluaran->qty }}
                                            </td>
                                            <td>
                                                {{ $pengeluaran->item->uom }}
                                            </td>
                                            <td>
                                                {{ $pengeluaran->price }}
                                            </td>
                                            <td>
                                                {{ $pengeluaran->expdate }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <div class="form-outline w-50 mb-4 ml-4">
                                <label class="form-label" for="remarks">Remarks</label>
                                <textarea class="form-control" id="remarks" rows="3" name="remarks" disabled>{{ $pengeluaran->remarks }}</textarea>
                            </div>
                            <br>
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
