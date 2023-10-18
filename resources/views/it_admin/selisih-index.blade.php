@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Selisih Stock') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close bg-white rounded" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                                <a href="{{ route('selisih.add') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                        autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Document
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
                                        <th>Document Number</th>
                                        <th>Document Date</th>
                                        <th>Admin</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        @if (in_array(auth()->user()->license, ['administrator', 'manager']))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($selisihs as $selisih)
                                        <tr class="text-center">
                                            <td><a
                                                    href="{{ route('selisih.edit', ['selisih' => $selisih->docnum]) }}">{{ $selisih->docnum }}</a>
                                            </td>
                                            <td>{{ $selisih->docdate }}</td>
                                            <td>{{ $selisih->admin }}</td>
                                            <td>{{ $selisih->remarks }}</td>
                                            <td>{{ $selisih->status }}</td>
                                            @if (in_array(auth()->user()->license, ['administrator', 'manager']))
                                                <td class="d-flex justify-content-center">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        @if ($selisih->status == 'Open')
                                                            <form action="/selisih/reject/{{ $selisih->docnum }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger">Reject</button>
                                                            </form>
                                                            {{-- <form action="/selisih/show/{{ $selisih->docnum }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning">Edit</button>
                                                    </form> --}}
                                                            <form action="/selisih/approve/{{ $selisih->docnum }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-success">Approve</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                {{ $selisihs->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
