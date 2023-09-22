@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Item Master Data') }}</h1>
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
                        <form action="{{ route('item.search') }}" method="GET" class="w-50">
                            <div class="col input-group w-50">
                                <input type="text" name="query" id="search" class="form-control"
                                    placeholder="Search for item ...">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        {{-- @foreach ($items as $item)
                            <!-- Display each live search result here -->
                            <div>{{ $item->name }}</div>
                        @endforeach --}}

                        <div class="col float-right w-50 text-right">
                            <div class=" pr-3 ">
                                <a href="{{ route('itemadd') }}"><button type="button" class="btn btn-primary"
                                        data-toggle="button" aria-pressed="false" autocomplete="off">
                                        <i class="bi bi-plus-lg pr-1"></i>
                                        Tambah Item
                                    </button></a>
                                <a href="{{ route('itemgroups.index') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false"
                                        autocomplete="off">
                                        <i class="bi bi-stack pr-1"></i>
                                        Item Group Management
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
                                        <th>Item Name</th>
                                        <th>Item Group</th>
                                        <th>UoM</th>
                                        <th>Price</th>
                                        <th>Expired Date</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->itemgroup->code }}</td>
                                            <td>{{ $item->uom }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->expdate }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    @unless ($item->status === 'inactive')
                                                        <form action="/items/inactive/{{ $item->id }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Inactive</button>
                                                        </form>
                                                    @endunless

                                                    <a href="{{ route('item.edit', ['item' => $item->id]) }}"><button type="button" class="btn btn-warning">Edit</button></a>

                                                    @unless ($item->status === 'active')
                                                        <form action="items/active/{{ $item->id }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Active</button>
                                                        </form>
                                                    @endunless
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
