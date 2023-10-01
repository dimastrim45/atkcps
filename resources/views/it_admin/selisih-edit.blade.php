@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Selisih Stock No - ') . $selisihs->first()->docnum }}</h1>
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
                                {{-- add admin and status --}}
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Admin</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                value="{{ $selisihs->first()->admin }}" disabled>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-6 col-form-label">Status</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"
                                                value="{{ $selisihs->first()->status }}" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <form action="{{ route('selisih.update', ['selisih' => $selisihs->first()->docnum]) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <table class="table" id="thetable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Item Name</th>
                                            <th>UoM</th>
                                            <th>Qty</th>
                                            @if (!in_array($selisihs->first()->status, ['Rejected', 'Approved']))
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selisihs as $selisih)
                                            <tr class="text-center">
                                                <td>
                                                    <select name="item_id[]" class="form-select w-100"
                                                        onchange="updateUOM(this)"
                                                        {{ in_array($selisih->status, ['Rejected', 'Approved']) ? 'disabled' : '' }}>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == old('item_id', $selisih->item_id) ? 'selected' : '' }}>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="col-sm-6 col-form-label text-center" type="text"
                                                        name="uom[]" id="uomInput" value="" disabled>
                                                </td>
                                                <td><input type="number" name="qty[]" value="{{ $selisih->qty }}"
                                                        {{ in_array($selisih->status, ['Rejected', 'Approved']) ? 'disabled' : '' }}>
                                                </td>
                                                @if (!in_array($selisih->status, ['Rejected', 'Approved']))
                                                    <td class="d-flex justify-content-center" id="removeBtn">
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic mixed styles example">
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="removeRow(this)">Remove</button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (!in_array($selisihs->first()->status, ['Rejected', 'Approved']))
                                    <button type="button" onclick="addRow()" class="ml-4">Add Item</button>
                                    <br>
                                @endif
                                <br>
                                <div class="form-outline w-50 mb-4 ml-4">
                                    <label class="form-label" for="remarks">Remarks</label>
                                    <textarea class="form-control" id="remarks" rows="3" name="remarks"
                                        {{ in_array($selisih->status, ['Rejected', 'Approved']) ? 'disabled' : '' }}>{{ $selisihs->first()->remarks }}</textarea>
                                </div>
                                @if (!in_array($selisihs->first()->status, ['Rejected', 'Approved']))
                                    <br>
                                    <input type="submit" value="Submit" class="ml-4 btn btn-success">
                                @endif
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
        <script>
            function addRow() {
                var table = document.getElementById("thetable").getElementsByTagName('tbody')[0];
                var newRow = table.insertRow(table.rows.length);
                newRow.classList.add("text-center");

                // Clone the first row (template)
                var templateRow = table.rows[0].cloneNode(true);

                // Reset input values in the new row (optional)
                templateRow.querySelectorAll('input[type="text"], input[type="number"]').forEach(function(input) {
                    input.value = "";
                });

                // Assign unique IDs to the UoM input field in the new row
                var uomInput = templateRow.querySelector('input[name="uom[]"]');
                uomInput.id = 'uomInput' + table.rows.length;

                table.appendChild(templateRow);
            }

            function removeRow(button) {
                var row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        </script>

        <script>
            var uomValues = {
                @foreach ($items as $item)
                    '{{ $item->id }}': '{{ $item->uom }}',
                @endforeach
            };

            // Initialize UoM values for the existing rows and also for the initial load
            document.querySelectorAll('select[name="item_id[]"]').forEach(function(selectElement) {
                updateUOM(selectElement);
            });

            function updateUOM(selectElement) {
                var selectedItem = selectElement.value;
                var row = selectElement.closest('tr');
                var uomInput = row.querySelector('input[name="uom[]"]');
                uomInput.value = uomValues[selectedItem] || '';
            }
        </script>
    </div>
    <!-- /.content -->
@endsection
