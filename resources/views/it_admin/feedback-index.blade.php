@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Feedback') }}</h1>
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
                                <button type="button" class="btn btn-primary" aria-pressed="false" autocomplete="off"
                                    data-toggle="modal" data-target="#exampleModal">
                                    <i class="bi bi-plus-lg pr-1"></i>
                                    Tambah Feedback
                                </button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Feedback
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="feedback-form" action="{{ route('feedback.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body" class="">
                                            <div class="form-group">
                                                <label for="topic">Insert Topic</label>
                                                <input type="text" class="form-control" id="topic" name="topic">
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
                                        <th>Feedback Number</th>
                                        <th>User Name</th>
                                        <th>Date</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $feedback)
                                        <tr class="text-center">
                                            <td><a
                                                    href="{{ route('chat', ['feedback' => $feedback->feedback_docnum]) }}">{{ $feedback->feedback_docnum }}</a>
                                            </td>
                                            <td>{{ $feedback->user->name }}</td>
                                            <td>{{ $feedback->docdate }}</td>
                                            <td>{{ $feedback->user->plant->name }}</td>
                                            <td>{{ $feedback->status }}</td>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Find the form and submit button by their IDs
            const form = document.getElementById('feedback-form');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(event) {
                // Disable the submit button to prevent double-click
                submitButton.disabled = true;
                submitButton.innerHTML = 'Submitting...'; // Optionally, change the button text

                // You can also prevent the form from submitting immediately, allowing you to perform validation
                // or other tasks. If everything is valid, you can submit the form programmatically.
                // Example: form.submit();
            });
        });
    </script>
@endsection
