@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('List User') }}</h1>
                </div>
                <div class="col-sm-6 float-right text-right">
                    <div class=" pr-3 ">
                        <a href="{{ route('userlist-report.print-pdf') }}" target="_blank"><button type="button" class="btn btn-primary"
                                data-toggle="button" aria-pressed="false" autocomplete="off">
                                <i class="bi bi-printer pr-1"></i>
                                Print
                            </button></a>
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
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Branch</th>
                                        <th>Department</th>
                                        <th>License</th>
                                        <th>Create Date</th>
                                        <th>Update Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ isset($user->plant->name) ? $user->plant->name : '' }}</td>
                                            <td>{{ $user->department }}</td>
                                            <td>{{ $user->license }}</td>
                                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $user->updated_at->format('d-m-Y') }}</td>
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
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: '{{ route('item.search') }}', // Replace with your search route
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        // Update the search results div with the received data
                        $('#search-results').html(data);
                    }
                });
            });
        });
    </script>
@endsection
