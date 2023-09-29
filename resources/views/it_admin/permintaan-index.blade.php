@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('List Permintaan') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                                <a href="{{ route('permintaanadd') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                        autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Permintaan
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Request Number</th>
                                        <th>Requester</th>
                                        <th>Request Date</th>
                                        <th>Due Date</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permintaans as $permintaan)
                                        <tr class="text-center">
                                            <td><a
                                                    href="{{ route('permintaan.show', ['permintaan' => $permintaan->docnum]) }}">{{ $permintaan->docnum }}</a>
                                            </td>
                                            <td>{{ $permintaan->requester }}</td>
                                            <td>{{ $permintaan->docdate }}</td>
                                            <td>{{ $permintaan->duedate }}</td>
                                            <td>{{ $permintaan->user->plant->name }}</td>
                                            <td>{{ $permintaan->status }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    @if ($permintaan->status == 'Open')
                                                        <form action="/permintaan/reject/{{ $permintaan->docnum }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger mr-2">Reject</button>
                                                        </form>
                                                        <form action="/permintaan/close/{{ $permintaan->docnum }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Close</button>
                                                        </form>
                                                    @endif
                                                </div>
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
