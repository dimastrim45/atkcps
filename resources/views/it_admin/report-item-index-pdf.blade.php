<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        /* Apply some basic styles to the table */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .custom-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .custom-table tbody tr {
            background-color: #fff;
            /* White background color for all tr elements in tbody */
        }

        .custom-table tr:hover {
            background-color: #ddd;
        }

        /* Center text in table cells */
        .custom-table th,
        .custom-table td {
            text-align: center;
        }
    </style>
    <!-- Content Header (Page header) -->
    <center>
        <h3 class=" p-2"><b>Item Master Data</b></h3>
    </center> <!-- /.content-header -->

    <!-- Main content -->
    <div class=" pt-3">
        <table class="custom-table">
            <thead>
                <tr class="text-center">
                    <th>Item Name</th>
                    <th>Item Group</th>
                    <th>UoM</th>
                    <th>Price</th>
                    <th>Expired Date</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Create Date</th>
                    <th>Update Date</th>
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
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->updated_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- /.card-body -->

    <!-- /.content -->
</body>

</html>
