@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Users') }}</h1>
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
                            <input type="text" class="form-control" placeholder="Search for user ...">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col float-right w-50 text-right">
                            {{-- <div class=" pr-3">
                                <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                    autocomplete="off">
                                    <i class="bi bi-plus-lg pr-1"></i>
                                    Tambah Item
                                </button>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Branch</th>
                                        <th>Department</th>
                                        <th>License</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->branch }}</td>
                                            <td>{{ $user->department }}</td>
                                            <td>{{ $user->license }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <form method="POST" action="{{ route('users.delete', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">Remove</button>
                                                    </form>
                                                    <a href="user/edit/{{ $user->email }}"><button type="button"
                                                            class="btn btn-warning">Edit</button></a>
                                                    {{-- user/remove/{{ $user->email }} --}}
                                                    {{-- <button type="button" class="btn btn-success">Right</button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
