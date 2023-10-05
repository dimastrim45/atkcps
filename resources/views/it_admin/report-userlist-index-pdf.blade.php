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
        <h3 class=" p-2"><b>List User</b></h3>
    </center> <!-- /.content-header -->

    <!-- Main content -->
    <div class=" pt-3">
        <table class="custom-table">
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

    <!-- /.content -->
</body>

</html>
