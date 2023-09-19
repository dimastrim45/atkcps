@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Tambah Permintaan') }}</h1>
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
                    <div class="card">
                        <div class="card-body p-0">
                            <form action="{{ route('permintaanadd.store') }}" method="POST">
                                @csrf
                                <div class="row pl-2 m-2">
                                    {{ 'Due Date' }}
                                    <input type="date" class="ml-2" name="duedate">
                                </div>
                                <table class="table" id="thetable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Item Name</th>
                                            <th>Available Qty</th>
                                            <th>UoM</th>
                                            <th>Price</th>
                                            <th>Expired Date</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td class=" w-25">
                                                <select name="item_id[]" class="form-select w-100"
                                                    onchange="updateFields(this)">
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input class="form-control form-control-sm text-center" type="availqty"
                                                    name="availqty[]" id="availqtyInput" value="" readonly></td>
                                            <td>
                                                <input class="form-control form-control-sm text-center" type="text"
                                                    name="uom[]" id="uomInput" value="" readonly>
                                            </td>
                                            <td><input class="form-control form-control-sm text-center" type="number"
                                                    name="price[]" id="priceInput" value="" readonly></td>
                                            <td><input class="form-control form-control-sm text-center" type="date"
                                                    name="expdate[]" id="expdateInput" value="" readonly></td>
                                            <td><input type="number" name="qty[]"></td>
                                            <td class="d-flex justify-content-center" id="removeBtn">
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="removeRow(this)">Remove</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" onclick="addRow()" class="ml-4">Add Item</button>
                                <br>
                                <br>
                                <div class="form-outline w-50 mb-4 ml-4">
                                    <label class="form-label" for="remarks">Remarks</label>
                                    <textarea class="form-control" id="remarks" rows="3" name="remarks"></textarea>
                                </div>
                                <br>
                                <input type="submit" value="Submit" class="ml-4 btn btn-success">
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
            function updateFields(selectElement) {
                var selectedItem = selectElement.value;
                var row = selectElement.closest('tr');

                // Update UoM input
                var uomInput = row.querySelector('input[name="uom[]"]');
                uomInput.value = uomValues[selectedItem] || '';

                // Update Price input
                var priceInput = row.querySelector('input[name="price[]"]');
                priceInput.value = priceValues[selectedItem] || '';

                // Update Expdate input
                var expdateInput = row.querySelector('input[name="expdate[]"]');
                expdateInput.value = expdateValues[selectedItem] || '';

                // Update Available Qty input
                var availqtyInput = row.querySelector('input[name="availqty[]"]');
                availqtyInput.value = availqtyValues[selectedItem] || '';
            }

            var uomValues = {
                @foreach ($items as $item)
                    '{{ $item->id }}': '{{ $item->uom }}',
                @endforeach
            };

            var priceValues = {
                @foreach ($items as $item)
                    '{{ $item->id }}': '{{ $item->price }}',
                @endforeach
            };

            var expdateValues = {
                @foreach ($items as $item)
                    '{{ $item->id }}': '{{ $item->expdate }}',
                @endforeach
            };

            var availqtyValues = {
                @foreach ($items as $item)
                    '{{ $item->id }}': '{{ $item->qty }}',
                @endforeach
            };

            // Initialize values for the existing rows
            document.querySelectorAll('select[name="item_id[]"]').forEach(function(selectElement) {
                updateFields(selectElement);
            });
        </script>

    </div>
    <!-- /.content -->
@endsection
