@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Permintaan - ') . $permintaans->first()->docnum }}</h1>
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
                            <div class="row pl-2 m-2 d-flex justify-content-between">
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Due Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                value="{{ $permintaans->first()->duedate }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Doc Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                value="{{ $docDate }}" disabled>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">requester</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                value="{{ $permintaans->first()->requester }}" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table class="table" id="thetable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item Name</th>
                                        <th>Qty</th>
                                        <th>Open Qty</th>
                                        <th>UoM</th>
                                        <th>Price</th>
                                        <th>Expired Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permintaans as $permintaan)
                                        <tr class="text-center">
                                            <td class=" w-25">
                                                {{ $permintaan->item->name }}
                                            </td>
                                            <td>
                                                {{ $permintaan->qty }}
                                            </td>
                                            <td>
                                                {{ $permintaan->openqty }}
                                            </td>
                                            <td>
                                                {{ $permintaan->item->uom }}
                                            </td>
                                            <td>
                                                {{ $permintaan->price }}
                                            </td>
                                            <td>
                                                {{ $permintaan->expdate }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <div class="form-outline w-50 mb-4 ml-4">
                                <label class="form-label" for="remarks">Remarks</label>
                                <textarea class="form-control" id="remarks" rows="3" name="remarks" disabled>{{ $permintaan->remarks }}</textarea>
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
