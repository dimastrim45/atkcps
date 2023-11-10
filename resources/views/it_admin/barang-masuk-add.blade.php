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
                            <form action="{{ route('barangmasukadd.store') }}" method="POST">
                                @csrf
                                <div class="row pl-2 m-2">
                                    {{ 'Nomor PO' }}
                                    <input type="text" class="ml-2" name="nomorpo">
                                </div>
                                <table class="table" id="thetable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Item ID</th>
                                            <th>Item Name</th>
                                            <th>UoM</th>
                                            <th>Price</th>
                                            <th>Expired Date</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>
                                                <input class="form-control form-control-sm text-center" type="text"
                                                    name="item_id[]" id="itemIdInput" value="" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="item_name" class="form-control item-search"
                                                    placeholder="Search for an item" autocomplete="off">
                                                <div class="search-results"></div>
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-center" type="text"
                                                    name="uom[]" id="uomInput" value="" readonly>
                                            </td>
                                            <td><input type="text" name="price[]"
                                                    oninput="calculateSubtotal(this); updateTotalRow(document.getElementById('thetable'));">
                                            </td>
                                            <td><input type="date" name="expdate[]"></td>
                                            <td><input type="number" name="qty[]"
                                                    oninput="calculateSubtotal(this); updateTotalRow(document.getElementById('thetable'));">
                                            </td>
                                            <td>
                                                <input type="hidden" name="subtotal[]"
                                                    class="form-control form-control-sm text-right" readonly>
                                                <input type="text" name="subtotalString[]"
                                                    class="form-control form-control-sm text-right" readonly>
                                            </td>
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
                                <!-- Separate table for the "Total" row -->
                                <table class="table" id="totaltable">
                                    <tbody>
                                        <tr id="totalRow">
                                            <td colspan="6"></td>
                                            <td class="font-weight-bold text-right">Total:</td>
                                            <td style="width: 25%;">
                                                <input type="text" class="form-control form-control-sm text-right"
                                                    value="0.00" readonly>
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
                                <input type="submit" value="Submit" class="ml-4 btn btn-success" id="submitBtn">
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            const items = @json($items); // Pass the items from your Laravel controller

            // Handle the "Add Row" button click
            $('#addRowButton').click(function() {
                addRow();
            });

            // Handle the "Remove" button click
            $(document).on('click', '.removeRowButton', function() {
                removeRow(this);
            });

            // Handle the "input" event for the "Item Name" search
            $(document).on('input', '.item-search', function() {
                const searchTerm = $(this).val().toLowerCase();
                const resultsContainer = $(this).siblings('.search-results');
                const results = items.filter(item => item.name.toLowerCase().includes(searchTerm));

                resultsContainer.empty();

                if (results.length > 0) {
                    results.forEach(item => {
                        // Include the class 'search-result-item' here
                        const resultItem =
                            `<div class="result-item search-result-item" data-id="${item.id}">${item.name}</div>`;
                        resultsContainer.append(resultItem);
                    });
                } else {
                    resultsContainer.append('<div class="result-item">No results found</div>');
                }
            });

            // Handle the click event for selecting an item from the search results
            $(document).on('click', '.result-item', function() {
                const selectedItemId = $(this).data('id');
                const selectedItemUom = $(this).data('uom');
                const selectedItem = items.find(item => item.id === selectedItemId);
                const row = $(this).closest('tr');

                row.find('input[name="item_name"]').val(selectedItem.name);
                row.find('input[name="item_id[]"]').val(selectedItem.id); // Set the item ID
                row.find('input[name="uom[]"]').val(selectedItem.uom); // Set the item ID

                $(this).parent().empty(); // Clear the search results
            });
        </script>


        <script>
            function formatNumber(number) {
                return number.toLocaleString('en-US', {
                    style: 'decimal',
                    maximumFractionDigits: 2
                });
            }

            function calculateSubtotal(input) {
                const row = input.closest('tr');
                const price = parseFloat(row.querySelector('input[name="price[]"]').value) || 0;
                const qty = parseFloat(row.querySelector('input[name="qty[]"]').value) || 0;
                const subtotal = price * qty;
                // row.querySelector('input[name="subtotal[]"]').value = subtotal.toFixed(2); // You can format as needed
                // Format subtotal with thousand separator
                // Format subtotal with thousand separator
                const formattedSubtotal = subtotal.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                // Set the actual numerical value
                row.querySelector('input[name="subtotal[]"]').value = subtotal.toFixed(2);

                // Set the formatted value for display
                row.querySelector('input[name="subtotalString[]"]').value = formattedSubtotal;
            }

            function addRow() {
                var table = document.getElementById("thetable").getElementsByTagName('tbody')[0];

                // Clone the template row
                var templateRow = table.rows[0].cloneNode(true);

                // Reset input values in the new row
                templateRow.querySelectorAll('input[type="text"], input[type="number"]').forEach(function(input) {
                    input.value = "";
                });

                // Clear the search results
                templateRow.querySelector('.search-results').innerHTML = '';

                // Assign a unique ID to the UoM input field in the new row
                var newRowNumber = table.rows.length;
                var uomInput = templateRow.querySelector('input[name="uom[]"]');
                uomInput.id = 'uomInput' + newRowNumber;

                // Set the subtotal in the new row to 0
                var subtotalInput = templateRow.querySelector('input[name="subtotal[]"]');
                subtotalInput.value = "0";

                // Add the new row to the table
                table.appendChild(templateRow);
            }

            // Function to update the Total row
            function updateTotalRow(table) {
                var total = 0;
                var subtotalInputs = table.querySelectorAll('input[name="subtotal[]"]');

                // Calculate the total by summing up all the subtotal values
                subtotalInputs.forEach(function(input) {
                    total += parseFloat(input.value) || 0;
                });

                // Format total with thousand separator and two decimal places
                var formattedTotal = total.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                // Update the "Total" row
                var totalRow = document.getElementById('totalRow');
                var totalCell = totalRow.querySelector('input[type="text"]');
                totalCell.value = formattedTotal;
            }

            function removeRow(button) {
                var row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        </script>


    </div>
    <!-- /.content -->
@endsection
