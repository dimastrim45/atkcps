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
                {{ 'Nomor PO' }}
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <form action="">
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
                                        {{-- @foreach ($users as $user) --}}
                                        <tr class="text-center">
                                            <td><input type="text" name="item_name[]"></td>
                                            <td><input type="text" name="uom[]"></td>
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
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                                <button type="button" onclick="addRow()">Add Item</button>
                                <br><br>
                                <input type="submit" value="Submit">
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

                var itemNameCell = newRow.insertCell(0);
                var uomCell = newRow.insertCell(1);
                var priceCell = newRow.insertCell(2);
                var expdateCell = newRow.insertCell(3);
                var qtyCell = newRow.insertCell(4);
                var actionCell = newRow.insertCell(5);

                itemNameCell.innerHTML = '<input type="text" name="item_name[]">';
                uomCell.innerHTML = '<input type="text" name="uom[]">';
                priceCell.innerHTML = '<input type="number" name="price[]">';
                expdateCell.innerHTML = '<input type="date" name="expdate[]">';
                qtyCell.innerHTML = '<input type="number" name="qty[]">';
                actionCell.innerHTML = `
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                        </div>
                                    `;
            }

            function removeRow(button) {
                var row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        </script>

        <script></script>
    </div>
    <!-- /.content -->
@endsection
