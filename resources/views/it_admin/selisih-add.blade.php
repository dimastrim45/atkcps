@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Tambah Selisih Item') }}</h1>
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
                            <form action="{{ route('selisih.store') }}" method="POST">
                                @csrf
                                <table class="table" id="thetable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Item ID</th>
                                            <th>Item Name</th>
                                            <th>UoM</th>
                                            <th>Qty</th>
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

        {{-- <script>
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
        </script> --}}
    </div>
    <!-- /.content -->
@endsection
