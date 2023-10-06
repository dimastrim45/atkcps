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
        <h3 class=" p-2"><b>List Pengeluaran By Date</b></h3>
    </center> <!-- /.content-header -->

    <!-- Main content -->
    <div class=" pt-3">
        <table class="custom-table">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nomor Pengeluaran</th>
                    <th>Status</th>
                    <th>Admin</th>
                    <th>Requester</th>
                    <th>Branch</th>
                    <th>Doc. Date</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Exp Date</th>
                    <th>Price</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($pengeluarans as $pengeluaran)
                    <tr class="text-center">
                        <td>{{ $i++ }}</td>
                        <td>{{ $pengeluaran->docnum }}</td>
                        <td>{{ $pengeluaran->status }}</td>
                        <td>{{ $pengeluaran->admin }}</td>
                        <td>{{ $pengeluaran->requester }}</td>
                        <td>{{ $pengeluaran->user->plant->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($pengeluaran->docdate)) }}</td>
                        <td>{{ $pengeluaran->item->name }}</td>
                        <td>{{ $pengeluaran->qty }}</td>
                        <td>{{ date('d-m-Y', strtotime($pengeluaran->expdate)) }}</td>
                        <td>{{ $pengeluaran->price }}</td>
                        <td class="word-wrap: break-word w-25">
                            {{ $pengeluaran->remarks }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- /.card-body -->

    <!-- /.content -->
</body>

</html>
