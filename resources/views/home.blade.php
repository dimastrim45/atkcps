@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
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
                        <div class="card-body">
                            <p class="card-text bg-black">
                                {{ __('You are logged in! ha') }}
                                <button type="button" class="btn btn-danger">Danger</button>
                            </p>
                            {{-- toast --}}
                            <div class="toast align-items-center text-bg-primary border-0" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Hello, world! This is a toast message.
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>

                            {{-- spinners --}}
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden"></span>
                            </div>

                            {{-- POPOOVER --}}
                            <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover"
                                data-bs-title="Popover title"
                                data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to
                                toggle popover</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
@endsection
