@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Barang Masuk - ') . $barangmasuks->first()->docnum }}</h1>
                </div>
                <!-- /.col -->
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
                                {{-- add admin and status --}}
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Nomor PO</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                value="{{ $barangmasuks->first()->po_docnum }}" disabled>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Doc Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" value="{{ $docDate }}" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table class="table" id="thetable">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item Name</th>
                                        <th>UoM</th>
                                        <th>Price</th>
                                        <th>Expired Date</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangmasuks as $barangmasuk)
                                        <tr class="text-center">
                                            <td>
                                                {{ $barangmasuk->item->name }}
                                            </td>
                                            <td>
                                                {{ $barangmasuk->item->uom }}
                                            </td>
                                            <td>
                                                {{ $barangmasuk->price }}
                                            </td>
                                            <td>
                                                {{ $barangmasuk->expdate }}
                                            </td>
                                            <td>
                                                {{ $barangmasuk->qty }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <div class="form-outline w-50 mb-4 ml-4">
                                <label class="form-label" for="remarks">Remarks</label>
                                <textarea class="form-control" id="remarks" rows="3" name="remarks" disabled>{{ $barangmasuk->remarks }}</textarea>
                            </div>
                            <br>
                            </form>
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
