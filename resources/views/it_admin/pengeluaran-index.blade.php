@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Pengeluaran Barang') }}</h1>
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
                    <div class="row mb-2">
                        <div class="col input-group w-50">
                            <input type="text" class="form-control" placeholder="Search for item ...">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col float-right w-50 text-right">
                            <div class=" pr-3">
                                <button type="button" class="btn btn-primary" aria-pressed="false" autocomplete="off"
                                    data-toggle="modal" data-target="#exampleModal">
                                    <i class="bi bi-plus-lg pr-1"></i>
                                    Tambah Pengeluaran Barang
                                </button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran Barang
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('pengeluaranadd') }}" method="GET">
                                        @csrf
                                        <div class="modal-body" class="">
                                            <div class="form-group">
                                                <label for="permintaan_docnum">Nomor Permintaan</label>
                                                <input type="text" class="form-control" id="permintaan_docnum"
                                                    name="permintaan_docnum">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nomor Pengeluaran</th>
                                        <th>Admin</th>
                                        <th>Requester</th>
                                        <th>Document Date</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengeluarans as $pengeluaran)
                                        <tr class="text-center">
                                            <td><a href="{{ route('pengeluaran.show', ['pengeluaran' => $pengeluaran->docnum]) }}">{{ $pengeluaran->docnum }}</a></td>
                                            <td>{{ $pengeluaran->admin }}</td>
                                            <td>{{ $pengeluaran->requester }}</td>
                                            <td>{{ $pengeluaran->docdate }}</td>
                                            <td>{{ $pengeluaran->user->branch }}</td>
                                            <td>{{ $pengeluaran->status }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn btn-danger">Cancel</button>
                                                    <button type="button" class="btn btn-warning">Open</button>
                                                    <button type="button" class="btn btn-success">Picked</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
