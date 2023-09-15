@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Tambah Barang Masuk') }}</h1>
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
                            <form action="{{ route('barangmasukadd.store') }}" method="POST">
                                @csrf
                                <div class="row pl-2 m-2">
                                    {{ 'Nomor PO' }}
                                    <input type="text" class="ml-2" name="nomorpo">
                                </div>
                                <table class="table" id="thetable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Item Name</th>
                                            <th>UoM</th>
                                            <th>Price</th>
                                            <th>Expired Date</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>
                                                <select name="item_id[]" class="form-select w-100"
                                                    onchange="updateUOM(this)">
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="" type="text" name="uom[]" id="uomInput"
                                                    value="" readonly>
                                            </td>
                                            <td><input type="number" name="price[]"></td>
                                            <td><input type="date" name="expdate[]"></td>
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

            // Update UoM based on the selected item in the row
            function updateUOM(selectElement) {
                var selectedItem = selectElement.value;
                var row = selectElement.closest('tr');
                var uomInput = row.querySelector('input[name="uom[]"]');
                uomInput.value = uomValues[selectedItem] || '';
            }
        </script>

        <script>
            var uomValues = {
                @foreach ($items as $item)
                    '{{ $item->id }}': '{{ $item->uom }}',
                @endforeach
            };

            // function updateUOM(selectElement) {
            //     var selectedItem = selectElement.value;
            //     var uomInput = document.getElementById('uomInput');
            //     uomInput.value = uomValues[selectedItem] || '';
            // }

            // Initialize UoM values for the existing rows
            document.querySelectorAll('select[name="item_name[]"]').forEach(function(selectElement) {
                updateUOM(selectElement);
            });
        </script>
    </div>
    <!-- /.content -->
@endsection
